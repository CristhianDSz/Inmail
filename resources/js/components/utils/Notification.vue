<template></template>

<script>
export default {
  props: ["message"],
  mounted() {
    this.notificate(this.message);
  },

  methods: {
    notificate(message = null) {
      return this.$swal({
        title: "Bien hecho!",
        text: message,
        type: "success"
      });
    }
  }
};
</script>
