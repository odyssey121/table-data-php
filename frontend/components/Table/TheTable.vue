<template>
  <div>
    <table class="table">
      <tr class="table__header">
        <th class="text-left">Date</th>
        <th class="text-center">Name</th>
        <th class="text-center">Quantity</th>
        <th class="text-center">Distance</th>
      </tr>
      <template v-if="!getLoading">
        <tr v-for="(record,index) in getDistances" :key="index">
          <td>{{record.date}}</td>
          <td>{{record.name}}</td>
          <td>{{record.quantity}}</td>
          <td>{{record.distance}} метров</td>
        </tr>
      </template>
      <template v-else>
        <div class="loader"></div>
      </template>
    </table>
  </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
export default {
  name: "TheTable",
  props: ["currentPage"],

  computed: {
    ...mapGetters("main", ["getCurrentPage", "getLoading"]),
    getDistances() {
        return this.$store.getters["main/getDistances"](this.getCurrentPage);
    }
  },

};
</script>
<style scoped>
.table__icon svg:last-child {
  color: red;
}
.table__icon svg :hover {
  cursor: pointer;
}
.table__icon {
  display: flex;
  justify-content: space-around;
}

.table {
  width: 100%;
  background: #fff;
  border-color: grey;
  border-collapse: collapse;
  border-spacing: 0;
  border-right: 1px solid var(--border-color);
  border-left: 1px solid var(--border-color);
}
.table > tr:not(.table__header):hover {
  background: #fafafa;
}
.table > tr > td {
  padding: 1rem;
  border-bottom: 1px solid var(--border-color);
}
.table > tr > th {
  padding: 1rem;
  border-bottom: 1px solid var(--border-color);
  border-top: 1px solid var(--border-color);
}


.table__header th {
  font-weight: normal;
}
.modal-btn {
  margin-top: 2rem;
  display: flex;
  justify-content: space-between;
}
</style>
