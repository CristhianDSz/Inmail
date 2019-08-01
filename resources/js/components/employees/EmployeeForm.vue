<template>
  <form @submit.prevent="postEmployee" class="form-layout form-layout-2">
    <div class="row no-gutters">
      <div class="col-md-4">
        <div class="form-group">
          <label class="form-control-label">
            Documento de identidad:
            <span class="tx-danger">*</span>
          </label>
          <input
            class="form-control"
            type="text"
            name="firstname"
            v-model="employee.identification"
            placeholder="Cédula de ciudadanía"
          >
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label class="form-control-label">
            Nombres:
            <span class="tx-danger">*</span>
          </label>
          <input
            class="form-control"
            type="text"
            name="firstname"
            v-model="employee.firstname"
            placeholder="Ingrese los nombres"
          >
        </div>
      </div>
      <!-- col-4 -->
      <div class="col-md-4 mg-t--1 mg-md-t-0">
        <div class="form-group mg-md-l--1">
          <label class="form-control-label">
            Apellidos:
            <span class="tx-danger">*</span>
          </label>
          <input
            class="form-control"
            type="text"
            name="lastname"
            v-model="employee.lastname"
            placeholder="Ingrese los apellidos"
          >
        </div>
      </div>
      <div class="col-md-4 mg-t--1 mg-md-t-0">
        <div class="form-group mg-md-l--1">
          <label class="form-control-label">
            Dependencia:
            <span class="tx-danger">*</span>
          </label>
          <select v-model="employee.dependency_id" class="select2-container">
            <option
              v-for="dependency in dependencies"
              :key="dependency.id"
              :value="dependency.id"
            >{{dependency.name}}</option>
          </select>
        </div>
      </div>
      <!-- col-4 -->
    </div>
    <!-- row -->
    <div class="form-layout-footer bd pd-20 bd-t-0 text-right">
      <button class="btn btn-info" type="submit">Registrar</button>
    </div>
    <!-- form-group -->
  </form>
</template>

<script>
export default {
  data() {
    return {
      employee: {
        identification: "",
        firstname: "",
        lastname: "",
        dependency_id: ""
      },
      dependencies: []
    };
  },
  created() {
    this.getDependencies();
  },
  methods: {
    getDependencies() {
      axios.get("/dependencies").then(dependencies => {
        this.dependencies = dependencies.data.data;
        this.employee.dependency_id = dependencies.data.data[0].id;
        this.$emit("dependencies", dependencies.data.data);
      });
    },
    postEmployee() {
      axios.post("/employees", this.employee).then(response => {
        console.log(response.data);
        this.$emit("success");
        this.resetForm();
      });
    },

    resetForm() {
      for (let prop in this.employee) {
        this.employee[prop] = "";
      }
    }
  }
};
</script>
