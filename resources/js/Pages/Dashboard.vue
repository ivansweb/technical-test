<template>
    <h1>hello world</h1>
    {{ laravelVersion }}

</template>

<script>


  export default {
    name: 'Welcome',

    props: {
      'laravelVersion': String
    }
  }

</script>
