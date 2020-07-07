<template>
  <div class="form-layout form-layout-2">
    <form @submit.prevent="validateForm">
      <div class="row no-gutters">
        <div class="col-md-4">
          <div class="form-group">
            <label class="form-control-label">
              Tipo de radicado:
              <span class="tx-danger">*</span>
            </label>
            <select
              class="form-control"
              name="type"
              v-validate="'required|alpha'"
              data-vv-as="tipo"
              v-model="record.type"
            >
              <option value="Entrada">Entrada</option>
              <option value="Salida">Salida</option>
            </select>
            <small class="text-danger" v-if="errors.has('type')">{{errors.first('type')}}</small>
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
              v-validate="'alpha'"
              data-vv-as="tipo"
              type="text"
              value="Correo"
              :disabled="true"
            />
            <select
              class="form-control"
              name="document_type"
              v-validate="'alpha'"
              data-vv-as="tipo"
              v-model="record.document_type"
              v-else
            >
              <option value="Correo">Correo</option>
              <option value="Facturas">Facturas</option>
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
            <input
              class="form-control"
              placeholder="Correspondiente a..."
              v-model="record.description"
            />
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group mg-md-l--1 bd-t-0-force">
            <label class="form-control-label">Anexos:</label>
            <input
              class="form-control"
              placeholder="Viene en adjuntos..."
              v-model="record.attacheds"
            />
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
              :selectLabel="''"
              :deselectLabel="''"
              :maxHeight="200"
              v-model="thirdPartyRecord"
              :options="thirdParties"
              label="name"
              placeholder="Seleccione"
            ></multiselect>
            <a
              class="text-secondary tx-bold text-right d-block mx-auto text-right"
              href="#"
              @click.prevent="showThirdPartyForm"
            >
              <i class="tx-11 icon ion-plus"></i>
              <span class="tx-11">Agregar tercero</span>
            </a>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group mg-md-l--1 bd-t-0-force">
            <label class="form-control-label">Dependencia:</label>
            <multiselect
              class="form-control"
              :selectLabel="''"
              :deselectLabel="''"
              :maxHeight="400"
              v-model="dependencyRecord"
              :options="dependencies"
              label="name"
              @input="getEmployees(dependencyRecord.id)"
              placeholder="Seleccione"
            ></multiselect>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group mg-md-l--1 bd-t-0-force">
            <label class="form-control-label">Empleado:</label>
            <multiselect
              class="form-control"
              :selectLabel="''"
              :deselectLabel="''"
              :maxHeight="200"
              v-model="employeeRecord"
              :options="employees"
              label="firstname"
              placeholder="Seleccione"
            ></multiselect>
          </div>
        </div>
        <div class="col-md-2">
          <div class="form-group mg-md-l--1 bd-t-0-force">
            <label class="form-control-label">Copias:</label>
            <input
              class="form-control"
              name="copy"
              v-validate="'required|numeric|min_value:1|max_value:15'"
              data-vv-as="copias"
              placeholder="Cantidad de copias"
              v-model="record.copy"
            />
            <small class="text-danger" v-if="errors.has('copy')">{{errors.first('copy')}}</small>
          </div>
        </div>
        <div class="col-md-2">
          <div class="form-group mg-md-l--1 bd-t-0-force">
            <label class="form-control-label"># Radicados:</label>
            <input
              class="form-control"
              name="quantity"
              v-validate="'required|numeric|min_value:1|max_value:15'"
              data-vv-as="cantidad"
              placeholder="Cantidad de copias"
              v-model="record.quantity"
            />
            <small class="text-danger" v-if="errors.has('quantity')">{{errors.first('quantity')}}</small>
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
      employees: [],
      //Multiselect
      thirdPartyRecord: "",
      dependencyRecord: "",
      employeeRecord: "",
      createThirdParty: false
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
      return axios.get("/third-parties/data");
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
    async validateForm() {
      let valid = await this.$validator.validateAll();
      if (valid) {
        this.postRecord();
        return;
      }
      this.$swal(
        "Error",
        "Debe corregir los errores antes de continuar",
        "error"
      );
    },
    postRecord() {
      this.record.third_party_id = this.thirdPartyRecord.id || "";
      this.record.dependency_id = this.dependencyRecord.id || "";
      this.record.employee_id = this.employeeRecord.id || "";
      axios
        .post("/records", this.record)
        .then(response => {
          this.$swal({
            title: "Correcto",
            text: response.data.message,
            type: "success",
            confirmButtonText: "Generar pdf"
          }).then(result => {
            if (result.value) {
              this.postRecordsPdf(response.data.records);
            }
          });
          this.$emit("success");
          this.resetRecord();
        })
        .catch(error => {
          if (error.response.status == 400) {
            return this.$swal({
              title: "Ha ocurrido un error",
              text: error.response.data.message,
              type: "error"
            });
          }
        });
    },
    postRecordsPdf(records) {
      axios
        .post(`/app/records/pdf`, records, {
          responseType: "arraybuffer",
          headers: { Accept: "application/pdf" }
        })
        .then(response => {
          this.$validator.reset();
          let blob = new Blob([response.data], { type: "application/pdf" });
          let link = document.createElement("a");
          let url = window.URL.createObjectURL(blob);
          let windowPrint = window.open(url);
          windowPrint.focus();
          windowPrint.print();
        });
    },
    resetRecord() {
      this.record = {
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
      };
    },
    showThirdPartyForm() {
      this.$emit("createThirdParty");
    }
  }
};
</script>
