<template>
  <div id="app">
    <div id="mainSheet">
      <nuxt />
    </div>
  </div>
</template>

<script>
export default {
    created() {
    this.$router.push('/table');
  },
}
</script>