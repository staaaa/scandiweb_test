<template>
  <div class="wrapper">
    <Line />
    <p class="title">ScandiWeb Test Task</p>
  </div>
</template>
<script>
import Line from "./Line.vue";
export default {
  components: {
    Line,
  },
};
</script>
<style scoped>
.wrapper {
  width: 100%;
  height: 50px;
  display: flex;
  align-items: center;
  flex-direction: column;
}
.title {
  margin-top: 10px;
  font-size: 30px;
}
</style>
