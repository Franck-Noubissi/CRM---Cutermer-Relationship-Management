<template>
  <div id="right">
    <h1>Planification des tâches</h1>

    <div class="horizontal">
      <img src="../images/horizontal.png" alt="horizontal" />
    </div>

    <p>Planifiez les tâches de vos projets en toute sérénité.</p>

    <div class="task">
      <div class="add-tasks">
        <h2>Tâches à réaliser</h2>

        <div class="add-action">
          <img src="../images/add.png" alt="add-icon" />
        </div>
      </div>

      <ul class="tasks-list"></ul>
    </div>

    <div class="upcoming">
      <div class="add-tasks">
        <h2>Tâches</h2>

        <div class="add-action">
          <img src="../images/add.png" alt="" />
        </div>
      </div>

      <form action="" @submit="addUpcomingTask">
        <input type="text" v-model="newTask" />
      </form>

      <ul class="tasks-list">
        <li v-for="upcomingtask in upcoming" v-bind:key="upcomingtask.id">
          <div class="info">
            <div class="left">
              <label class="myCheckbox">
                <input
                  type="checkbox"
                  name="test"
                  :checked="upcomingtask.completed"
                  @change="checkUpcoming(upcomingtask.taskId)"
                />
                <span></span>
              </label>

              <h4>{{ upcomingtask.title }}</h4>
            </div>

            <div class="right">
              <img src="../images/edit.png" alt="" />
              <img
                src="../images/del.png"
                alt=""
                @click="delUpcoming(upcomingtask.taskId)"
              />
            </div>
          </div>
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      todayTask: [],
      upcoming: [],
      newTask: "",
    };
  },

  created() {
    this.fetchTodayTasks();
    this.fetchUpcoming();
  },

  methods: {
    //** Upcoming Task method */
    // Get upcoming tasks
    fetchUpcoming() {
      fetch("/api/upcoming")
        .then((res) => res.json())
        .then(({ data }) => {
          this.upcoming = data;
        })
        .catch((err) => console.log(err));
    },

    // Add Upcoming task
    addUpcomingTask(e) {
      e.preventDefault();

      if (this.upcoming.length > 4) {
        alert(
          "Terminez d'abord les tâches ci-dessous pour en ajouter d'autres."
        );
      } else {
        const newTask = {
          title: this.newTask,
          waiting: true,
          taskId: Math.random().toString(36).substring(7),
        };

        // POST request
        fetch("/api/upcoming", {
          method: "POST",
          headers: {
            "content-type": "application/json",
          },
          body: JSON.stringify(newTask),
        }).then(() => this.upcoming.push(newTask));

        // Clear ou reset new task
        this.newTask = "";
      }
    },

    // Delete upcoming task
    delUpcoming(taskId) {
      if (confirm("Etes-vous sûr de vouloir supprimer cette tâche ?")) {
        fetch(`/api/upcoming/${taskId}`, {
          method: "delete",
        })
          .then((res) => res.json())
          .then(() => {
            this.upcoming = this.upcoming.filter(
              ({ taskId: id }) => id !== taskId
            );
          })
          .catch((err) => console.log(err));
      }
    },

    // Check upcoming tasks
    checkUpcoming(taskId) {
      if (this.todayTask.lenght > 4) {
        alert("Désolé, veuillez terminer les tâches à réaliser");
        window.location.href = "/";
      } else {
        this.addDailyTask(taskId);

        // Delete this task from upcoming task table in db
        fetch(`/api/upcoming/${taskId}`, { method: "delete" }).then(
          () =>
            (this.upcoming = this.upcoming.filter(
              ({ taskId: id }) => id !== taskId
            ))
        );
      }
    },

    //** Today Task method */
    // Get today task
    fetchTodayTasks() {},

    // Add daily task
    addDailyTask(taskId) {},
  },
};
</script>

<style>
</style>