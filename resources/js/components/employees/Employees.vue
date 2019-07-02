<template>
  <div class="bd bd-gray-300 rounded table-responsive">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Documento de identidad</th>
          <th>Nombres</th>
          <th>Apellidos</th>
          <th>Dependencia</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <employee
          v-for="employee in employees"
          :key="employee.id"
          :data="employee"
          :dependenciesData="dependencies"
          @deleted="getEmployees"
        ></employee>
      </tbody>
    </table>
  </div>
</template>

<script>
import Employee from "./Employee";
export default {
  components: {
    Employee
  },
  data() {
    return {
      employees: [],
      dependencies: []
    };
  },
  created() {
    this.getEmployees();
    dependenciesEmitter.$on("dependencies", data => {
      this.dependencies = data;
    });
  },
  methods: {
    getEmployees() {
      axios.get("/employees").then(employees => {
        this.employees = employees.data;
      });
    }
  }
};
</script>
