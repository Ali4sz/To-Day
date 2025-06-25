<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="api-base-url" content="{{ url('/api') }}">
    <title>to-day | Your Tasks</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&family=Pacifico&display=swap"
        rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />
</head>

<body>

    <nav class="navbar">
        <div class="navbar-brand">
            <a href="{{ route('home') }}" class="logo">to<span class="logo-accent">day</span></a>
        </div>
        <div class="navbar-nav">
            <ul>
                <li><a href="#" class="nav-link active" data-section="today">Today's Tasks</a></li>
                <li><a href="#" class="nav-link" data-section="all">All Tasks</a></li>
                <li><a href="#" class="nav-link" data-section="add">+ Add New</a></li>
                <li><a href="#" class="nav-link" data-section="settings">Settings</a></li>
            </ul>
        </div>
        <div class="navbar-extra">
            <!-- Example: Theme toggle or user profile -->
            <span class="theme-toggle">☀️</span>
        </div>
    </nav>

    <main class="tasks-page-main-container">
        <!-- This wrapper will now contain the switchable views -->
        <div class="tasks-page-content-wrapper">

            <!-- View for Today's Tasks (includes input and list) -->
            <div id="todayTasksView" class="tasks-view active-view">
                <header class="tasks-page-header">
                    <h1 class="tasks-page-title">
                        Today's Focus
                        <span class="tasks-page-title-accent">.</span>
                    </h1>
                    <p class="tasks-page-subtitle">What will you accomplish today?</p>
                </header>

                <section class="tasks-input-section">
                    <div class="tasks-input-group">
                        <input type="text" id="taskInput" class="tasks-input-field"
                            placeholder="e.g., Finish project proposal by 5 PM">
                        <span class="tasks-input-focus-line"></span>
                    </div>
                    <button id="addTaskBtn" class="tasks-add-button">
                        Add Task
                    </button>
                </section>

                <section class="tasks-list-section">
                    <h2 class="tasks-list-heading">Your Tasks (Today)</h2>

                    <ul id="taskListToday" class="tasks-list-ul">

                    </ul>
                    <p id="tasksEmptyStateToday" class="tasks-empty-state-message">
                        No tasks for today yet. Add some!
                    </p>
                </section>
            </div>

            <!-- View for All Tasks -->
            <div id="allTasksView" class="tasks-view">
                <header class="tasks-page-header">
                    <h1 class="tasks-page-title">
                        All Your Tasks
                        <span class="tasks-page-title-accent">.</span>
                    </h1>
                    <p class="tasks-page-subtitle">A complete overview of your commitments.</p>
                </header>
                <!-- Optional: Add task input here too if desired for this view -->
                <section class="tasks-list-section">
                    <h2 class="tasks-list-heading">All Tasks</h2>
                    <ul id="taskListAll" class="tasks-list-ul">

                    </ul>
                    <p id="tasksEmptyStateAll" class="tasks-empty-state-message">
                        You have no tasks at all. Time to plan!
                    </p>
                </section>
            </div>

            <!-- View for Adding a New Task (NEW) -->
            <div id="addTaskFormView" class="tasks-view">
                <header class="tasks-page-header">
                    <h1 class="tasks-page-title">
                        Add New Task
                        <span class="tasks-page-title-accent">.</span>
                    </h1>
                    <p class="tasks-page-subtitle">Plan your next accomplishment.</p>
                </header>
                <section class="add-task-form-section">

                    <div id="addTaskMessageArea" class="message-area"></div>

                    <form id="newTaskForm" data-action-url="{{ route('store') }}">
                        <div class="form-group">
                            <label for="newTaskName">Task Name</label>
                            <input type="text" id="newTaskName" name="taskName" required
                                placeholder="e.g., Prepare presentation slides">
                        </div>

                        <div class="form-group">
                            <label for="newTaskDueDate">Due Date & Time (Optional)</label>
                            <input type="datetime-local" id="newTaskDueDate" name="dueDate">
                        </div>

                        <div class="form-group">
                            <label for="newTaskPriority">Priority</label>
                            <select id="newTaskPriority" name="priority">
                                <option value="low">Low</option>
                                <option value="medium" selected>Medium</option>
                                <option value="high">High</option>
                            </select>
                        </div>

                        <div class="form-actions-group">
                            <button type="submit" class="tasks-add-button" id="saveNewTaskBtn">
                                <i class="fas fa-plus-circle"></i> Save Task
                            </button>
                            <button type="button" class="tasks-cancel-button" id="cancelAddTaskBtn">
                                Cancel
                            </button>
                        </div>
                    </form>
                </section>
            </div> <!-- addTaskFormView END -->

            <!-- View for Settings -->
            <div id="settingsView" class="tasks-view">
                <header class="tasks-page-header">
                    <h1 class="tasks-page-title">
                        Settings
                        <span class="tasks-page-title-accent">.</span>
                    </h1>
                    <p class="tasks-page-subtitle">Customize your to-day experience.</p>
                </header>
                <section>
                    <p style="text-align: center; padding: 20px; color: #777;">Settings content will go here.</p>

                    <div class="setting-item">

                    </div>

                </section>
            </div>

        </div> <!-- tasks-page-content-wrapper END -->
    </main>

    <!-- Edit Task Modal -->
    <div id="editTaskModal" class="modal-overlay hidden">
        <div class="modal-content">
            <button class="modal-close-btn" aria-label="Close modal">×</button>
            <h2>Edit Task</h2>
            <div id="editTaskMessageArea" class="my-3"></div>
            <form id="editTaskForm">
                <div class="form-group">
                    <label for="editTaskName">Task Name</label>
                    <input type="text" id="editTaskName" name="taskName" required>
                </div>

                <div class="form-group">
                    <label for="editTaskDueDate">Due Date & Time</label>
                    <input type="datetime-local" id="editTaskDueDate" name="dueDate">
                </div>

                <div class="form-group">
                    <label for="editTaskPriority">Priority</label>
                    <select id="editTaskPriority" name="priority">
                        <option value="low">Low</option>
                        <option value="medium">Medium</option>
                        <option value="high">High</option>
                    </select>
                </div>

                <div class="form-actions-group">
                    <button type="submit" class="tasks-add-button" id="saveTaskChangesBtn">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>


</body>

</html>