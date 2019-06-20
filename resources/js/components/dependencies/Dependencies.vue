<template>
  <div class="bd bd-gray-300 rounded table-responsive">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Nombre</th>
          <th>Código</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <dependency
          v-for="dependency in dependencies"
          :key="dependency.id"
          :data="dependency"
          @deleted="getDependencies"
        ></dependency>
      </tbody>
    </table>
  </div>
</template>

<script>
import Dependency from "./Dependency";
export default {
  components: {
    Dependency
  },
  data() {
    return {
      dependencies: []
    };
  },
  created() {
    this.getDependencies();
  },
  methods: {
    getDependencies() {
      axios.get("/dependencies").then(dependencies => {
        this.dependencies = dependencies.data;
      });
    }
  }
};
</script>

<style>
</style>
