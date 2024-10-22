<template>
  <div>
    <h2>{{ message }}</h2>
    <button @click="changeMessage">Change Message</button>
  </div>
</template>

<script>
export default {
  data() {
    return {
      message: 'Hello from Vue!'
    };
  },
  methods: {
    changeMessage() {
      this.message = 'Message changed!';
    }
  }
};
</script>