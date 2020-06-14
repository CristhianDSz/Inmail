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
      <a href="#" @click.prevent="emitEvent('recordClick', {record,edit:true})" v-if="showEditOption">
        <i class="icon ion-edit tx-22 p-2 tx-teal"></i>
      </a>

      <a href="#" title="Ver detalles" @click.prevent="emitEvent('recordClick', {record:data,edit:false})" v-if="showDetailsOption">
        <i class="icon ion-eye tx-22 p-2 tx-teal"></i>
      </a>

      <a href="#" @click.prevent="deleteRecord" v-if="$can('delete records')">
        <i class="icon ion-trash-a tx-22 p-2 tx-teal"></i>
      </a>
    </td>
  </tr>
</template>

<script>
import Modal from "../utils/Modal";
import { permissionMixin} from '../../mixins/PermissionsMixin.js'
export default {
  components: { Modal },
  mixins: [permissionMixin],
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
    },

    emitEvent(name, data) {
        this.$emit(name,data)
    }
  },
  computed: {
    datetimeFormat() {
      return moment(this.data.datetime).format("MM-DD-YYYY HH:mm");
    },
    showEditOption() {
      return (this.$can('edit records') && (this.data.status == 'Creado' ||
      this.data.status == 'Registrado')) || 
      this.$can('edit delivered records');
    },
    showDetailsOption () {
      return this.data.status === "Entregado" || this.data.status === "Visado Control Interno" || this.data.status === 'Visado Contabilidad'
    }
  }
};
</script>