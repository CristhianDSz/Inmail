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
            v-model="record.invoice_number"
          />
        </div>
      </div>
      <!-- col-8 -->
      <div class="col-md-4">
        <div class="form-group mg-md-l--1 bd-t-0-force">
          <label class="form-control-label">Descripción:</label>
          <textarea
            class="form-control"
            cols="30"
            rows="3"
            placeholder="Correspondiente a..."
            v-model="record.description"
          ></textarea>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group mg-md-l--1 bd-t-0-force">
          <label class="form-control-label">Anexos:</label>
          <textarea
            class="form-control"
            cols="30"
            rows="3"
            placeholder="Viene en adjuntos..."
            v-model="record.attacheds"
          ></textarea>
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
            <option value>Seleccione</option>
            <template v-if="thirdParties.length">
              <option
                v-for="thirdParty in thirdParties"
                :key="thirdParty.id"
                :value="thirdParty.id"
              >{{thirdParty.name}}</option>
            </template>
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
            <option value>Seleccione</option>
            <template v-if="dependencies.length">
              <option
                v-for="dependency in dependencies"
                :key="dependency.id"
                :value="dependency.id"
              >{{dependency.name}}</option>
            </template>
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
            <option value>Seleccione</option>
            <template v-if="employees.length">
              <option
                v-for="employee in employees"
                :key="employee.id"
                :value="employee.id"
              >{{employee.firstname}}</option>
            </template>
          </select>
        </div>
      </div>
      <div class="col-md-2">
        <div class="form-group mg-md-l--1 bd-t-0-force">
          <label class="form-control-label">Copias:</label>
          <input class="form-control" placeholder="Cantidad de copias" v-model="record.copy" />
        </div>
      </div>
      <div class="col-md-2">
        <div class="form-group mg-md-l--1 bd-t-0-force">
          <label class="form-control-label">Cantidad de radicados:</label>
          <input class="form-control" placeholder="Cantidad de copias" v-model="record.quantity" />
        </div>
      </div>
    </div>
    <div class="form-layout-footer bd pd-20 bd-t-0">
      <button class="btn btn-info" @click="postRecord">Registrar</button>
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
        invoice_number: "",
        description: "",
        attacheds: "",
        dependency_id: "",
        third_party_id: "",
        employee_id: "",
        copy: 2,
        quantity: 1
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
          this.$emit("dependencies", dependencies.data);
          this.$emit("thirdParties", thirdParties.data);
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
        this.$emit("employees", this.employees);
      }
    },
    postRecord() {
      axios.post("/records", this.record).then(response => {
        console.log(response.data);
        this.$emit("success");
        this.resetRecord();
      });
    },
    resetRecord() {
      this.record = {
        type: "Entrada",
        document_type: "Correo",
        document_date: "",
        dependency_id: "",
        third_party_id: "",
        employee_id: ""
      };
    }
  }
};
</script>