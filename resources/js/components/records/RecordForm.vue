<template>
  <div class="form-layout form-layout-2">
    <div class="row no-gutters">
      <div class="col-md-4">
        <div class="form-group">
          <label class="form-control-label">
            Tipo de radicado:
            <span class="tx-danger">*</span>
          </label>
          <select class="form-control" v-model="record.type">
            <option value="Entrada">Entrada</option>
            <option value="Salida">Salida</option>
          </select>
        </div>
      </div>
      <!-- col-4 -->
      <div class="col-md-4 mg-t--1 mg-md-t-0">
        <div class="form-group mg-md-l--1">
          <label class="form-control-label">
            Tipo de documento:
            <span class="tx-danger">*</span>
          </label>

          <input
            v-if="record.type == 'Salida'"
            class="form-control"
            type="text"
            value="Correo"
            :disabled="true"
          />
          <select class="form-control" v-model="record.document_type" v-else>
            <option value="Correo">Correo</option>
            <option value="Factura">Factura</option>
          </select>
        </div>
      </div>
      <!-- col-4 -->
      <div class="col-md-4 mg-t--1 mg-md-t-0">
        <div class="form-group mg-md-l--1">
          <label class="form-control-label">Fecha del documento:</label>
          <input class="form-control" type="date" v-model="record.document_date" />
        </div>
      </div>
      <!-- col-4 -->
      <div class="col-md-4">
        <div class="form-group bd-t-0-force">
          <label class="form-control-label">Número de factura:</label>
          <input
            class="form-control"
            type="text"
            placeholder="Nro. de factura"
            :disabled="record.document_type == 'Correo'"
          />
        </div>
      </div>
      <!-- col-8 -->
      <div class="col-md-4">
        <div class="form-group mg-md-l--1 bd-t-0-force">
          <label class="form-control-label">Descripción:</label>
          <textarea class="form-control" cols="30" rows="3" placeholder="Correspondiente a..."></textarea>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group mg-md-l--1 bd-t-0-force">
          <label class="form-control-label">Anexos:</label>
          <textarea class="form-control" cols="30" rows="3" placeholder="Viene en adjuntos..."></textarea>
        </div>
      </div>
      <!-- col-4 -->
    </div>
    <!-- row -->
    <div class="row no-gutters">
      <div class="col-md-4">
        <div class="form-group mg-md-l--1 bd-t-0-force">
          <label class="form-control-label">Tercero:</label>
          <select class="form-control" v-model="record.third_party_id">
            <option value="0">Seleccione</option>
            <option
              v-for="thirdParty in thirdParties"
              :key="thirdParty.id"
              :value="thirdParty.id"
            >{{thirdParty.name}}</option>
          </select>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group mg-md-l--1 bd-t-0-force">
          <label class="form-control-label">Dependencia:</label>
          <select
            class="form-control"
            v-model="record.dependency_id"
            @change="getEmployees(record.dependency_id)"
          >
            <option value="0">Seleccione</option>
            <option
              v-for="dependency in dependencies"
              :key="dependency.id"
              :value="dependency.id"
            >{{dependency.name}}</option>
          </select>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group mg-md-l--1 bd-t-0-force">
          <label class="form-control-label">Empleado:</label>
          <select
            class="form-control"
            v-model="record.employee_id"
            :disabled="record.dependency_id == '0'"
          >
            <option value="0">Seleccione</option>
            <option
              v-for="employee in employees"
              :key="employee.id"
              :value="employee.id"
            >{{employee.firstname}}</option>
          </select>
        </div>
      </div>
    </div>
    <div class="form-layout-footer bd pd-20 bd-t-0">
      <button class="btn btn-info">Submit Form</button>
      <button class="btn btn-secondary">Cancel</button>
    </div>
    <!-- form-group -->
  </div>
</template>

<script>
export default {
  data() {
    return {
      record: {
        type: "Entrada",
        document_type: "Correo",
        document_date: "",
        dependency_id: "0",
        third_party_id: "0",
        employee_id: "0"
      },
      thirdParties: [],
      dependencies: [],
      employees: []
    };
  },
  created() {
    this.getAllData();
  },
  methods: {
    getAllData() {
      axios.all([this.getThirdParties(), this.getDependencies()]).then(
        axios.spread((thirdParties, dependencies) => {
          this.thirdParties = thirdParties.data;
          this.dependencies = dependencies.data;
        })
      );
    },
    getThirdParties() {
      return axios.get("/third-parties");
    },
    getDependencies() {
      return axios.get("/dependencies/employees");
    },
    getEmployees(dependencyId) {
      if (this.dependencies.length) {
        let dependency = this.dependencies.find(dependency => {
          return dependency.id === dependencyId;
        });

        this.employees = dependency.employees.length
          ? dependency.employees
          : [];
      }
    },
    resetRecord() {
      this.record = {
        type: "Entrada",
        document_type: "Correo",
        document_date: "",
        dependency_id: "0",
        third_party_id: "0",
        employee_id: "0"
      };
    }
  }
};
</script>

<style>
</style>
