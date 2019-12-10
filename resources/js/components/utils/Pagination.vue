<template>
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
</template>

<script>
export default {
  data() {
    return {
      pagination: {},
      pagesNumber: 0,
      methodGet: ""
    };
  },
  methods: {
    setPagination(response) {
      this.pagination.next_page_url = response.data.next_page_url;
      this.pagination.prev_page_url = response.data.prev_page_url;
      this.pagination.last_page_url = response.data.last_page_url;
      this.pagination.current_page = response.data.current_page;
      this.pagination.last_page = response.data.last_page;
      this.pagination.total = response.data.total;
      this.pagination.from = response.data.from;
      this.pagination.to = response.data.total;
    },
    goToPage(page) {
      this.$emit('page',page);
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