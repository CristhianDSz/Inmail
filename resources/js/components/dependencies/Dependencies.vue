<template>
  <div class="rounded table-responsive">
    <table class="table">
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

    <div class="ht-80 bd d-flex align-items-center justify-content-center">
      <nav aria-label="Page navigation">
        <ul class="pagination pagination-basic mg-b-0">
          <li class="page-item" v-if="pagination.current_page > 1">
            <a
              class="page-link"
              href="#"
              @click.prevent="goToPage(pagination.current_page - 1)"
              aria-label="Last"
            >
              <span><</span>
            </a>
          </li>
          <li
            class="page-item"
            :class="{'active': page === pagination.current_page}"
            v-for="(page,index) in pagesNumber"
            :key="index"
          >
            <a class="page-link" href="#" @click.prevent="goToPage(page)">{{page}}</a>
          </li>
          <li class="page-item" v-if="pagination.current_page < pagination.last_page">
            <a
              class="page-link"
              href="#"
              @click.prevent="goToPage(pagination.current_page + 1)"
              aria-label="Last"
            >
              <span>></span>
            </a>
          </li>
        </ul>
      </nav>
    </div>
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
      dependencies: [],
      pagination: {},
      pagesNumber: 0
    };
  },
  created() {
    this.getDependencies();
  },
  methods: {
    getDependencies(page = 1) {
      axios.get("/dependencies?page=" + page).then(dependencies => {
        this.pagination.next_page_url = dependencies.data.next_page_url;
        this.pagination.prev_page_url = dependencies.data.prev_page_url;
        this.pagination.last_page_url = dependencies.data.last_page_url;
        this.pagination.current_page = dependencies.data.current_page;
        this.pagination.last_page = dependencies.data.last_page;
        this.pagination.total = dependencies.data.total;
        this.pagination.from = dependencies.data.from;
        this.pagination.to = dependencies.data.total;
        this.dependencies = dependencies.data.data;
        this.getPagesNumber();
      });
    },
    goToPage(page) {
      this.getDependencies(page);
    },
    getPagesNumber() {
      let from = this.pagination.current_page - 3;

      if (from < 1) {
        from = 1;
      }

      let to = from + 3 * 2;

      if (to > this.pagination.last_page) {
        to = this.pagination.last_page;
      }

      let pagesArray = [];
      while (from <= to) {
        pagesArray.push(from);
        from++;
      }
      this.pagesNumber = pagesArray;
    }
  }
};
</script>