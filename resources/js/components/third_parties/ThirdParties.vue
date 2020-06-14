<template>
  <div class="rounded table-responsive">
    <table class="table">
      <thead>
        <tr>
          <th>Cédula/NIT</th>
          <th class="text-center">Nombre</th>
          <th class="text-center">Dirección</th>
          <th class="text-center">Teléfono</th>
          <th class="text-center">Ciudad</th>
          <th class="text-center">Correo</th>
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
             <span class="icon ion-arrow-left-a"></span>
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
             <span class="icon ion-arrow-right-a"></span>
            </a>
          </li>
        </ul>
      </nav>
    </div>
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
      thirdParties: [],
      pagination: {},
      pagesNumber: 0
    };
  },
  created() {
    this.getThirdParties();
  },
  methods: {
    goToPage(page) {
      this.getThirdParties(page);
    },
    getThirdParties(page = 1) {
      axios.get("/third-parties?page=" + page).then(thirdParties => {
        this.pagination.next_page_url = thirdParties.data.next_page_url;
        this.pagination.prev_page_url = thirdParties.data.prev_page_url;
        this.pagination.last_page_url = thirdParties.data.last_page_url;
        this.pagination.current_page = thirdParties.data.current_page;
        this.pagination.last_page = thirdParties.data.last_page;
        this.pagination.total = thirdParties.data.total;
        this.pagination.from = thirdParties.data.from;
        this.pagination.to = thirdParties.data.total;
        this.thirdParties = thirdParties.data.data;
        this.getPagesNumber();
      });
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
