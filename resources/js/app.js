import "./bootstrap";
import "./ui-interactions";
import "./animations";

document.addEventListener("DOMContentLoaded", () => {
    // --- Initialize UI components from ui-interactions.js ---
    if (window.initThemeToggle) window.initThemeToggle();
    if (window.initFooterYear) window.initFooterYear();

    const navLinks = document.querySelectorAll(".navbar-nav .nav-link");
    const views = document.querySelectorAll(".tasks-view");
    const taskListAllUl = document.getElementById("taskListAll");
    const tasksEmptyStateAll = document.getElementById("tasksEmptyStateAll");
    const addTaskForm = document.getElementById("newTaskForm");
    const addTaskMessageArea = document.getElementById("addTaskMessageArea"); // Used by show/hide functions
    const cancelAddTaskBtn = document.getElementById("cancelAddTaskBtn");
    const saveNewTaskBtn = document.getElementById("saveNewTaskBtn");
    const taskListTodayUl = document.getElementById("taskListToday");
    const tasksEmptyStateToday = document.getElementById(
        "tasksEmptyStateToday"
    );

    let apiBaseUrl = ""; // Initialize
    const apiBaseUrlMeta = document.querySelector('meta[name="api-base-url"]');
    if (apiBaseUrlMeta) {
        apiBaseUrl = apiBaseUrlMeta.getAttribute("content");
    } else {
        console.warn(
            "Meta tag for api-base-url not found. API calls might fail."
        );
    }

    // --- Message Area Helper Functions (NEWLY INTEGRATED) ---
    function showTaskMessage(htmlContent, type = "info", duration = 4000) {
        if (!addTaskMessageArea) return;

        addTaskMessageArea.innerHTML = htmlContent; // Use innerHTML to allow basic HTML
        addTaskMessageArea.className = "message-area"; // Reset classes, keep ID
        addTaskMessageArea.classList.add(type); // Add specific type class (success, error, info)
        addTaskMessageArea.style.display = "block";

        // Clear message after a duration, if duration is not 0
        if (addTaskMessageArea.messageTimeout) {
            // Clear existing timeout
            clearTimeout(addTaskMessageArea.messageTimeout);
        }
        if (duration > 0) {
            addTaskMessageArea.messageTimeout = setTimeout(() => {
                hideTaskMessage();
            }, duration);
        }
    }

    function hideTaskMessage() {
        if (!addTaskMessageArea) return;
        addTaskMessageArea.style.display = "none";
        addTaskMessageArea.innerHTML = "";
        addTaskMessageArea.className = "message-area"; // Reset classes
        if (addTaskMessageArea.messageTimeout) {
            clearTimeout(addTaskMessageArea.messageTimeout);
            addTaskMessageArea.messageTimeout = null;
        }
    }
    // --- End Message Area Helper Functions ---

    // --- Initial View Setup based on URL or default ---
    function getSectionFromUrl() {
        const pathSegments = window.location.pathname
            .split("/")
            .filter((s) => s.length > 0);
        if (pathSegments.length === 0) return "today";

        const lastSegment = pathSegments[pathSegments.length - 1];
        const knownSections = ["today", "all", "add", "settings"];

        if (knownSections.includes(lastSegment)) {
            if (
                pathSegments.length > 1 &&
                pathSegments[pathSegments.length - 2] === "tasks"
            ) {
                return lastSegment;
            }
        }
        return "today";
    }

    function setActiveView(sectionId, updateUrl = true) {
        navLinks.forEach((link) => {
            link.classList.remove("active");
            if (link.dataset.section === sectionId) {
                link.classList.add("active");
            }
        });

        views.forEach((view) => {
            view.classList.remove("active-view");
            if (
                (sectionId === "today" && view.id === "todayTasksView") ||
                (sectionId === "all" && view.id === "allTasksView") ||
                (sectionId === "add" && view.id === "addTaskFormView") ||
                (sectionId === "settings" && view.id === "settingsView")
            ) {
                view.classList.add("active-view");
            }
        });

        if (updateUrl) {
            const currentPathname = window.location.pathname;
            let tasksBaseUrlPart = "";
            const pathSegments = currentPathname
                .split("/")
                .filter((s) => s.length > 0);

            if (pathSegments.length > 0) {
                const lastSegment = pathSegments[pathSegments.length - 1];
                const knownSections = ["today", "all", "add", "settings"];

                if (
                    knownSections.includes(lastSegment) &&
                    pathSegments.length > 1 &&
                    pathSegments[pathSegments.length - 2] === "tasks"
                ) {
                    tasksBaseUrlPart =
                        "/" + pathSegments.slice(0, -1).join("/");
                } else if (lastSegment === "tasks") {
                    tasksBaseUrlPart = "/" + pathSegments.join("/");
                } else {
                    const tasksIndex = pathSegments.indexOf("tasks");
                    if (tasksIndex > -1) {
                        tasksBaseUrlPart =
                            "/" +
                            pathSegments.slice(0, tasksIndex + 1).join("/");
                    } else {
                        console.warn(
                            "Could not determine tasks base URL for history update."
                        );
                        tasksBaseUrlPart = currentPathname.endsWith("/")
                            ? currentPathname.slice(0, -1)
                            : currentPathname;
                    }
                }
            }

            if (tasksBaseUrlPart.endsWith("/") && tasksBaseUrlPart.length > 1) {
                tasksBaseUrlPart = tasksBaseUrlPart.slice(0, -1);
            }

            const newUrl = `${tasksBaseUrlPart}/${sectionId}`;
            if (newUrl !== currentPathname && !newUrl.endsWith("undefined")) {
                // Prevent bad URL push
                try {
                    history.pushState(
                        { section: sectionId },
                        `Tasks - ${sectionId}`,
                        newUrl
                    );
                } catch (e) {
                    console.error(
                        "Error pushing state: ",
                        e,
                        "URL was: ",
                        newUrl
                    );
                }
            }
        }

        // Specific actions when a view becomes active
        if (sectionId === "today") {
            fetchTodaysTasks();
        } else if (sectionId === "all") {
            fetchAllTasks();
        } else if (sectionId === "add") {
            hideTaskMessage(); // Clear previous messages when switching to add view
            if (addTaskForm) addTaskForm.reset();
        } else {
            hideTaskMessage(); // Hide messages when switching to other views too
        }
    }

    // --- Navigation Handling ---
    navLinks.forEach((link) => {
        link.addEventListener("click", (e) => {
            e.preventDefault();
            const sectionId = e.target.closest(".nav-link").dataset.section;
            setActiveView(sectionId);
        });
    });

    window.addEventListener("popstate", (event) => {
        if (event.state && event.state.section) {
            setActiveView(event.state.section, false);
        } else {
            const sectionId = getSectionFromUrl();
            setActiveView(sectionId, false);
        }
    });

    // --- Utility to escape HTML ---
    function escapeHTML(str) {
        if (str === null || str === undefined) return "";
        return String(str).replace(/[&<>"']/g, function (match) {
            return {
                "&": "&", // Corrected escape for &
                "<": "<",
                ">": ">",
                '"': '"',
                "'": "'",
            }[match];
        });
    }

    // --- Task Rendering Function ---
    function createTaskListItemHTML(task) {
        const priorityClass = `priority-${task.priority}`;
        const isCompletedClass = task.is_completed ? "completed" : "";
        const checkboxChecked = task.is_completed ? "checked" : "";
        const isToday = task.is_today;
        const priorityLabelHTML =
            task.priority === "high" || task.priority === "medium"
                ? `<span class="task-priority-label">${escapeHTML(
                      task.priority
                  )} Priority</span>`
                : "";
        // const dueDateFormatted = task.due_date_formatted || "No due date";
        const displayDueDate = task.display_due_string || "No due date"; // Fallback just in cas

        return `
            <li class="task-item ${priorityClass} ${isCompletedClass}" data-task-id="${
            task.id
        }">
              <div class="task-priority-bar"></div>
              <div class="task-main-content">
                <input type="checkbox" class="task-complete-checkbox" data-task-id="${
                    task.id
                }" id="task-${
            task.id
        }" ${checkboxChecked} aria-label="Mark task as complete">
                <div class="task-details">
                  <label for="task-${task.id}" class="task-name">${escapeHTML(
            task.task_name
        )}</label>
                  <div class="task-meta">
                    <span class="task-due-time"><i class="fas fa-calendar-alt"></i> <span>${escapeHTML(
                        displayDueDate
                    )}</span></span>
                    ${priorityLabelHTML}
                  </div>
                </div>
              </div>
              <div class="task-actions">
                <button class="task-action-btn edit-btn" aria-label="Edit task" title="Edit Task">
                  <i class="fas fa-pencil-alt"></i>
                </button>
                <button class="task-action-btn delete-btn" aria-label="Delete task" title="Delete Task">
                  <i class="fas fa-trash-alt"></i>
                </button>
              </div>
            </li>
        `;
    }

    // --- Fetch All Tasks ---
    async function fetchAllTasks() {
        if (!taskListAllUl || !tasksEmptyStateAll) return; // Ensure elements exist

        taskListAllUl.innerHTML = "<li>Loading tasks...</li>";
        tasksEmptyStateAll.style.display = "none";

        try {
            if (!apiBaseUrl) throw new Error("API base URL not configured.");
            const fullApiUrl = `${apiBaseUrl}/tasks/all`;

            const response = await fetch(fullApiUrl);
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            const tasks = await response.json();

            taskListAllUl.innerHTML = "";
            if (tasks.length > 0) {
                tasks.forEach((task) => {
                    taskListAllUl.insertAdjacentHTML(
                        "beforeend",
                        createTaskListItemHTML(task)
                    );
                });
                tasksEmptyStateAll.style.display = "none";
            } else {
                tasksEmptyStateAll.style.display = "block";
            }
        } catch (error) {
            console.error("Could not fetch tasks:", error);
            taskListAllUl.innerHTML = `<li>Error loading tasks: ${escapeHTML(
                error.message
            )}</li>`;
            tasksEmptyStateAll.style.display = "none";
        }
    }
    // --- Fetch Today Tasks ---
    async function fetchTodaysTasks() {
        // Ensure the elements exist before trying to manipulate them
        if (!taskListTodayUl || !tasksEmptyStateToday) {
            console.warn("Today's task list elements not found.");
            return;
        }

        taskListTodayUl.innerHTML = "<li>Loading today's tasks...</li>";
        tasksEmptyStateToday.style.display = "none";

        try {
            const fullApiUrl = `${apiBaseUrl}/tasks/today`; // Use the new API endpoint

            const response = await fetch(fullApiUrl);
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            const tasks = await response.json();

            taskListTodayUl.innerHTML = ""; // Clear loading/previous
            if (tasks.length > 0) {
                tasks.forEach((task) => {
                    taskListTodayUl.insertAdjacentHTML(
                        "beforeend",
                        createTaskListItemHTML(task)
                    );
                });
                tasksEmptyStateToday.style.display = "none";
            } else {
                tasksEmptyStateToday.style.display = "block";
            }
        } catch (error) {
            console.error("Could not fetch today's tasks:", error);
            taskListTodayUl.innerHTML = `<li>Error loading today's tasks. Please try again. (${error.message})</li>`;
            tasksEmptyStateToday.style.display = "none";
        }
    }

    // --- Task Completed ---
    async function taskCompleted(event) {
        if (!event.target.matches(".task-complete-checkbox")) {
            return;
        }

        const checkbox = event.target;
        const taskId = checkbox.dataset.taskId; // Ensure checkbox has data-task-id
        const isCompleted = checkbox.checked;
        const taskItemLi = checkbox.closest(".task-item"); // Get the parent <li>
        const fullApiUrl = `${apiBaseUrl}/tasks/today`;
        const csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');
        const csrfToken = csrfTokenMeta
            ? csrfTokenMeta.getAttribute("content")
            : null;

        if (!taskId || !taskItemLi) {
            console.error(
                "Task ID or task item <li> not found for checkbox:",
                checkbox
            );
            return;
        }

        // Optimistic UI Update
        taskItemLi.classList.toggle("completed", isCompleted);

        try {
            const response = await fetch(fullApiUrl, {
                method: "PATCH",
                headers: {
                    "X-CSRF-TOKEN": csrfToken,
                    "Content-Type": "application/json",
                    Accept: "application/json",
                },
                body: JSON.stringify({ is_completed: isCompleted }),
            });
            const result = await response.json();
            if (!response.ok || !result.success) {
                taskItemLi.classList.toggle("completed", !isCompleted); // Toggle back
                checkbox.checked = !isCompleted; // Revert checkbox state
                alert(
                    `Error updating task: ${result.message || "Unknown error"}`
                );
                console.error("Failed to update task status:", result);
            }
        } catch (error) {
            // Network error or other fetch issue, revert optimistic update
            taskItemLi.classList.toggle("completed", !isCompleted);
            checkbox.checked = !isCompleted;
            alert(`Error updating task: ${error.message}`);
            console.error("Network or other error:", error);
        }
    }

    // --- Add New Task Form Submission ---
    if (addTaskForm && saveNewTaskBtn) {
        const originalButtonHTML = saveNewTaskBtn.innerHTML;

        addTaskForm.addEventListener("submit", async (e) => {
            e.preventDefault();
            hideTaskMessage(); // Clear previous messages first

            const formData = new FormData(addTaskForm);
            const actionUrl = addTaskForm.dataset.actionUrl; // Ensure this is set on your form
            const csrfTokenMeta = document.querySelector(
                'meta[name="csrf-token"]'
            );
            const csrfToken = csrfTokenMeta
                ? csrfTokenMeta.getAttribute("content")
                : null;

            if (!actionUrl) {
                showTaskMessage("Form action URL is not defined.", "error", 0);
                return;
            }
            if (!csrfToken) {
                showTaskMessage(
                    "CSRF token not found. Cannot submit form.",
                    "error",
                    0
                );
                return;
            }

            saveNewTaskBtn.disabled = true;
            saveNewTaskBtn.innerHTML = `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Saving...`;

            try {
                const response = await fetch(actionUrl, {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": csrfToken,
                        Accept: "application/json",
                    },
                    body: formData,
                });

                const result = await response.json();

                if (response.ok && result.success) {
                    showTaskMessage(
                        result.message || "Task saved successfully!",
                        "success"
                    );
                    addTaskForm.reset();

                    // Update task lists if the new task data is returned
                    if (result.task) {
                        if (
                            taskListAllUl &&
                            document
                                .getElementById("allTasksView")
                                .classList.contains("active-view")
                        ) {
                            taskListAllUl.insertAdjacentHTML(
                                "afterbegin",
                                createTaskListItemHTML(result.task)
                            );
                            if (tasksEmptyStateAll)
                                tasksEmptyStateAll.style.display = "none";
                        }
                        // Add to today's task list
                        const taskListTodayUl =
                            document.getElementById("taskListToday");
                        const tasksEmptyStateToday = document.getElementById(
                            "tasksEmptyStateToday"
                        );
                        if (
                            taskListTodayUl &&
                            document
                                .getElementById("todayTasksView")
                                .classList.contains("active-view")
                        ) {
                            // Ideally, check if task.due_date is today before adding
                            taskListTodayUl.insertAdjacentHTML(
                                "afterbegin",
                                createTaskListItemHTML(result.task)
                            );
                            if (tasksEmptyStateToday)
                                tasksEmptyStateToday.style.display = "none";
                        }
                    }
                    // Optionally switch view after successful save
                    setTimeout(() => {
                        setActiveView("today"); // Or 'all', depending on preference
                    }, 1500); // Delay to let user see success message
                } else {
                    let errorMessages = escapeHTML(
                        result.message || "An unknown error occurred."
                    );
                    if (result.errors) {
                        errorMessages +=
                            '<ul class="error-list" style="margin-top: 10px; padding-left: 20px;">';
                        for (const key in result.errors) {
                            result.errors[key].forEach((errMsg) => {
                                errorMessages += `<li>${escapeHTML(
                                    errMsg
                                )}</li>`;
                            });
                        }
                        errorMessages += "</ul>";
                    }
                    showTaskMessage(errorMessages, "error", 0); // Show error indefinitely until user acts
                }
            } catch (error) {
                console.error("Error submitting form:", error);
                showTaskMessage(
                    `A network error occurred: ${escapeHTML(error.message)}`,
                    "error",
                    0
                );
            } finally {
                saveNewTaskBtn.disabled = false;
                saveNewTaskBtn.innerHTML = originalButtonHTML;
            }
        });
    }

    if (cancelAddTaskBtn) {
        cancelAddTaskBtn.addEventListener("click", () => {
            setActiveView("today");
        });
    }

    if (taskListAllUl) {
        taskListAllUl.addEventListener("click", taskCompleted);
    }
    if (taskListTodayUl) {
        taskListTodayUl.addEventListener("click", taskCompleted);
    }
});
