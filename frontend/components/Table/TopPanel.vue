<template>
  <div class="table-controls">
    <div class="table-controls__search">
      <div class="control-search__left">
        <q-input lavel="search" placeholder="Искать" class="search-input" v-model="searchStr" style="width:280px">
          <template v-slot:append>
            <q-icon name="search" />
          </template>
        </q-input>

        <div class="q-pa-md q-gutter-sm flexeble">
          <q-btn
            class="glossy"
            rounded
            color="secondary"
            label="Найти"
            style="max-width:128px;"
            @click="applySearch"
          />
          <q-btn class="glossy" round color="negative" icon="delete_forever" @click="resetSearch" />
        </div>
      </div>
      <div class="control-search__right">
        <div class="" style="height:100%;width:240px;margin-top:32px">
          <q-select
            filled
            bottom-slots
            v-model="filters.column"
            :options="options"
            label="Фильрация"
          >
            <template v-slot:prepend>
              <q-icon name="filter" @click.stop />
            </template>
            <template v-slot:append>
              <q-icon name="close" @click.stop="resetFilters" class="cursor-pointer" />
            </template>
          </q-select>
        </div>
        <div class="q-pa-md q-gutter-sm">
          <div class="q-pa-md">
            <q-input
              label="От"
              v-model.number="filters.min"
              type="number"
              filled
              style="max-width: 100px"
            />
          </div>
        </div>
        <div class="q-pa-md q-gutter-sm">
          <div class="q-pa-md">
            <q-input
              label="До"
              v-model.number="filters.max"
              type="number"
              filled
              style="max-width: 100px"
            />
          </div>
        </div>
        <div class="q-pa-md q-gutter-sm flexeble">
          <q-btn
            class="glossy"
            rounded
            color="secondary"
            label="Применить"
            style="max-width:128px;"
            @click="applyFilters"
          />
          <q-btn class="glossy" round color="negative" icon="delete_forever" @click="resetFilters" />
        </div>
      </div>
    </div>
  </div>
</template>


<script>
import { mapGetters, mapActions } from "vuex";
export default {
  name: "TopPanel",
  computed: {},
  data() {
    return {
      searchStr: "",
      filterColumn: "",
      options: ["quantity", "distance"],
      filters: { column: "", min: "", max: "" }
    };
  },
  methods: {
    ...mapActions("main", ["fetchDistance", "setFilters"]),
    applySearch() {
      this.fetchDistance(this.searchStr);
    },
    applyFilters() {
      const { min, max, column } = this.filters;
      if (column && (max || min)) {
        this.setFilters(this.filters);
      }
    },
    resetSearch() {
      this.fetchDistance();
      this.searchStr = "";
    },
    resetFilters(val) {
      this.fetchDistance(this.searchStr);
      this.filters = { column: "", min: "", max: "" };
    }
  }
};
</script>
<style scoped>
.search-input {
  width: 40%;
  max-width: 40%;
}
.table-controls__search {
  display: flex;
  flex-wrap: nowrap;
  justify-content: space-around;

}
.control-search__left {
  display: flex;
}
.control-search__right {
  display: flex;
}

.row > div:first-child {
  width: 300px;
}
.row {
  display: flex;
  vertical-align: center;
  align-items: center;
}
@media (max-width: 768px) {
  .table-controls__search {
    flex-direction: column;
    justify-content: start;
  }
  .control-search__left {
    justify-content: space-between;
  }
}
.flexeble > button {
  height: 42px;
  display:block;
  align-self: center;
}
.flexeble{
  display:flex;
  vertical-align: center;

}
</style>
