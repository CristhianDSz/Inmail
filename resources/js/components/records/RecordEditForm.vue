<template>
  <div class="form-layout form-layout-2">
    <p class="mg-b-30 tx-semibold">{{record.number}}</p>
    <form @submit.prevent="validateForm">
      <div class="row no-gutters">
        <div class="col-md-4">
          <div class="form-group">
            <label class="form-control-label">
              Estado de Radicado:
              <span class="tx-danger">*</span>
            </label>
            <select
              class="form-control"
              name="status"
              v-validate="'required|alpha'"
              data-vv-as="estado"
              v-model="record.status"
            >
              <option value="Creado">Creado</option>
              <option value="Registrado">Registrado</option>
              <option value="Entregado">Entregado</option>
            </select>
            <small class="text-danger" v-if="errors.has('status')">{{errors.first('status')}}</small>
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
              name="document_type"
              v-validate="'required|alpha'"
              data-vv-as="tipo"
              type="text"
              value="Correo"
              :disabled="true"
            />
            <select
              class="form-control"
              name="document_type"
              v-validate="'required|alpha'"
              data-vv-as="tipo"
              v-model="record.document_type"
              v-else
            >
              <option value="Correo">Correo</option>
              <option value="Facturas">Facturas</option>
            </select>
            <small
              class="text-danger"
              v-if="errors.has('document_type')"
            >{{errors.first('document_type')}}</small>
          </div>
        </div>
        <!-- col-4 -->
        <div class="col-md-4 mg-t--1 mg-md-t-0">
          <div class="form-group mg-md-l--1">
            <label class="form-control-label">Fecha del documento:</label>
            <input
              class="form-control"
              type="date"
              name="document_date"
              v-validate="'required'"
              data-vv-as="fecha documento"
              v-model="record.document_date"
            />
            <small
              class="text-danger"
              v-if="errors.has('document_date')"
            >{{errors.first('document_date')}}</small>
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
            <input
              class="form-control"
              name="description"
              placeholder="Correspondiente a..."
              v-validate="'required|min:3'"
              data-vv-as="descripción"
              v-model="record.description"
            />
            <small
              class="text-danger"
              v-if="errors.has('description')"
            >{{errors.first('description')}}</small>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group mg-md-l--1 bd-t-0-force">
            <label class="form-control-label">Anexos:</label>
            <input
              class="form-control"
              name="attacheds"
              v-validate="'required|min:3'"
              data-vv-as="anexos"
              placeholder="Viene en adjuntos..."
              v-model="record.attacheds"
            />
            <small class="text-danger" v-if="errors.has('attacheds')">{{errors.first('attacheds')}}</small>
          </div>
        </div>
        <!-- col-4 -->
      </div>
      <!-- row -->
      <div class="row no-gutters">
        <div class="col-md-4">
          <div class="form-group mg-md-l--1 bd-t-0-force">
            <label class="form-control-label">Tercero:</label>
            <multiselect
              class="form-control"
              name="thirdParty"
              data-vv-as="Tercero"
              v-validate="'required|min:3'"
              :selectLabel="''"
              :deselectLabel="''"
              :maxHeight="200"
              v-model="currentThirdParty"
              track-by="id"
              :options="thirdParties"
              label="name"
              placeholder="Seleccione"
            ></multiselect>
            <small
              class="text-danger"
              v-if="errors.has('thirdParty')"
            >{{errors.first('thirdParty')}}</small>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group mg-md-l--1 bd-t-0-force">
            <label class="form-control-label">Dependencia:</label>
            <multiselect
              class="form-control"
              name="dependency"
              data-vv-as="Dependencia"
              v-validate="'required|min:3'"
              :selectLabel="''"
              :deselectLabel="''"
              :maxHeight="400"
              v-model="currentDependency"
              :options="dependencies"
              label="name"
              @input="getEmployees(currentDependency)"
              placeholder="Seleccione"
            ></multiselect>
            <small
              class="text-danger"
              v-if="errors.has('dependency')"
            >{{errors.first('dependency')}}</small>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group mg-md-l--1 bd-t-0-force">
            <label class="form-control-label">Empleado:</label>
            <multiselect
              class="form-control"
              name="employee"
              data-vv-as="Empleado"
              v-validate="'required|min:3'"
              :selectLabel="''"
              :deselectLabel="''"
              :maxHeight="200"
              v-model="currentEmployee"
              :options="employees"
              label="firstname"
              placeholder="Seleccione"
            ></multiselect>
            <small class="text-danger" v-if="errors.has('employee')">{{errors.first('employee')}}</small>
          </div>
        </div>
      </div>
      <div class="form-layout-footer bd pd-20 bd-t-0">
        <button type="submit" class="btn btn-teal">Registrar</button>
      </div>
    </form>
    <!-- form-group -->
  </div>
</template>

<script>
export default {
  props: ["record"],
  data() {
    return {
      recordStates: ["Creado", "Registrado", "Entregado"],
      thirdParties: [],
      dependencies: [],
      employees: [],
      //Multiselect
      currentThirdParty: "",
      currentDependency: "",
      currentEmployee: ""
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
          this.assignMultiSelectData();
        })
      );
    },

    getThirdParties() {
      return axios.get("/third-parties/data");
    },
    getDependencies() {
      return axios.get("/dependencies/employees");
    },
    assignMultiSelectData() {
      this.currentThirdParty =
        this.thirdParties.find(thirdParty => {
          return thirdParty.id === this.record.third_party_id;
        }) || null;
      this.currentDependency =
        this.dependencies.find(dependency => {
          return dependency.id === this.record.dependency_id;
        }) || null;
      this.getEmployees(this.currentDependency);
      this.currentEmployee =
        this.employees.find(employee => {
          return employee.id === this.record.employee_id;
        }) || null;
    },
    getEmployees(dependency) {
      if (dependency != null) {
        this.employees = dependency.employees.length
          ? dependency.employees
          : [];
      }
    },
    async validateForm() {
      let valid = await this.$validator.validateAll();
      if (valid) {
        this.putRecord();
        return;
      }
      this.$swal(
        "Error",
        "Debe corregir los errores antes de continuar",
        "error"
      );
    },
    putRecord() {
      this.record.third_party_id = this.currentThirdParty.id
      this.record.dependency_id = this.currentDependency.id
      this.record.employee_id = this.currentEmployee.id
      axios.put(`/records/${this.record.id}`, this.record).then(response => {
        this.$emit("success");
        this.$validator.reset();
      })
      .catch(error => {
        if (error.response.status == 400) {
          return this.$swal({
            title: 'Ha ocurrido un error',
            text: error.response.data.message,
            type: 'error'
          })
        }
      })
    }
  },
  watch: {
    record() {
      this.$validator.reset();
      this.assignMultiSelectData();
    }
  }
};
</script>