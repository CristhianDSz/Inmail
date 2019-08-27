<template>
  <tr>
    <td class="pd-l-0-force tx-semibold">{{data.number}}</td>
    <td class="tx-medium">{{data.type}}</td>
    <td class="tx-medium">{{datetimeFormat}}</td>
    <td class="tx-medium">{{data.document_type}}</td>
    <td class="tx-medium">
      <span class="square-8 mg-r-5 rounded-circle" :class="statusColors[data.status]"></span>
      {{data.status}}
    </td>

    <td>
      <a href="#" @click.prevent="$emit('recordClick', record)" v-if="showEditOption">
        <i class="icon ion-edit tx-22 p-2 tx-teal"></i>
      </a>

      <a href="#" title="Ver detalles" @click.prevent="$emit('recordDetailsClick', record)" v-if="showDetailsOption">
        <i class="icon ion-eye tx-22 p-2 tx-teal"></i>
      </a>

      <a href="#" @click.prevent="deleteRecord">
        <i class="icon ion-trash-a tx-22 p-2 tx-teal"></i>
      </a>
    </td>
  </tr>
</template>

<script>
import Modal from "../utils/Modal";
export default {
  components: { Modal },
  props: ["data", "dependenciesData", "thirdPartiesData", "employeesData"],
  data() {
    return {
      record: {},
      statusColors: {
        Creado: "bg-danger",
        Registrado: "bg-warning",
        Entregado: "bg-success",
        "Visado Control Interno": "bg-primary",
        "Visado Contabilidad": "bg-primary"
      }
    };
  },
  created() {
    this.record = this.data;
  },
  methods: {
    deleteRecord() {
      this.askingBeforeDelete().then(result => {
        if (result.value) {
          axios.delete(`/records/${this.record.id}`).then(response => {
            console.log(response.data);
            this.$emit("deleted");
            this.$swal("Eliminado", response.data.message, "success");
          });
        }
      });
    },

    askingBeforeDelete() {
      return this.$swal({
        title: "Está seguro (a)?",
        text: "Verifique antes de continuar!",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar!",
        confirmButtonColor: "#00b297",
        cancelButtonText: "Cancelar"
      });
    }
  },
  computed: {
    datetimeFormat() {
      return moment(this.data.datetime).format("MM/DD/YYYY HH:mm");
    },
    showEditOption() {
      return this.data.status === "Creado" || this.data.status === "Registrado";
    },
    showDetailsOption () {
      return this.data.status === "Entregado" || this.data.status === "Visado Control Interno"
    }
  }
};
</script>