<template>
  <div class="bd bd-gray-300 rounded table-responsive">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Cédula/NIT</th>
          <th class="text-center">Nombre</th>
          <th class="text-center">Dirección</th>
          <th class="text-center">Teléfono</th>
          <th class="text-center">Ciudad</th>
          <th class="text-center">Correo de contacto</th>
          <th class="text-center">Acciones</th>
        </tr>
      </thead>
      <tbody>
        <third-party
          v-for="thirdParty in thirdParties"
          :key="thirdParty.id"
          :data="thirdParty"
          @deleted="getThirdParties"
        ></third-party>
      </tbody>
    </table>
  </div>
</template>

<script>
import ThirdParty from "./ThirdParty";
export default {
  components: {
    ThirdParty
  },
  data() {
    return {
      thirdParties: []
    };
  },
  created() {
    this.getThirdParties();
  },
  methods: {
    getThirdParties() {
      axios.get("/third-parties").then(thirdParties => {
        this.thirdParties = thirdParties.data;
      });
    }
  }
};
</script>
