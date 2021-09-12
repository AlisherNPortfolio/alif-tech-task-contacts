<template>
    <notifications width="15%" position="bottom right"/>
</template>
<script>
export default {
    name: 'notification'
}
</script>
<style lang="scss">
.vue-notification {
  padding: 10px;
  margin: 20px 15px 5px;

  font-size: 15px;

  color: #ffffff;
  background: #44A4FC;
  border-left: 5px solid #187FE7;

  &.warn {
    background: #ffb648;
    border-left-color: #f48a06;
  }

  &.error {
    background: #E54D42;
    border-left-color: #B82E24;
  }

  &.success {
    background: #68CD86;
    border-left-color: #42A85F;
  }
}
</style>
