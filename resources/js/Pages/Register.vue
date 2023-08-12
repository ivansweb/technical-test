<template>
  <div class="flex min-h-full flex-1 flex-col justify-center px-6 py-12 lg:px-8 h-full min-w-full bg-gray-900">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
      <img class="mx-auto h-10 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=500" alt="Your Company" />
      <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-white">Register on the App</h2>
    </div>

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
      <form @submit.prevent="submit" class="space-y-6" action="#" method="POST">
        <div>
          <label for="email" class="block text-sm font-medium leading-6 text-white">Name</label>
          <div class="mt-2">
            <input v-model="name" class="block w-full rounded-md border-0 bg-white/5 py-1.5 text-white shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:text-sm sm:leading-6" />
            <div v-if="$page.props.errors.name" v-text="$page.props.errors.name" class="text-red-500 text-xs mt-1"></div>
          </div>
        </div>

        <div>
          <label for="email" class="block text-sm font-medium leading-6 text-white">Email address</label>
          <div class="mt-2">
            <input v-model="email" class="block w-full rounded-md border-0 bg-white/5 py-1.5 text-white shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:text-sm sm:leading-6" />
            <div v-if="$page.props.errors.email" v-text="$page.props.errors.email" class="text-red-500 text-xs mt-1"></div>
          </div>
        </div>

        <div>
          <div class="flex items-center justify-between">
            <label for="password" class="block text-sm font-medium leading-6 text-white">Password</label>

          </div>
          <div class="mt-2">
            <input type="password" v-model="password" autocomplete="current-password" required="" class="block w-full rounded-md border-0 bg-white/5 py-1.5 text-white shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:text-sm sm:leading-6" />
          </div>
        </div>

        <div>
          <div class="flex items-center justify-between">
            <label for="password" class="block text-sm font-medium leading-6 text-white">Retype Password</label>

          </div>
          <div class="mt-2">
            <input type="password" v-model="c_password" autocomplete="current-password" required="" class="block w-full rounded-md border-0 bg-white/5 py-1.5 text-white shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:text-sm sm:leading-6" />
          </div>
        </div>

        <div>
          <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-500 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">
            Register
          </button>
        </div>
      </form>

    </div>
  </div>

</template>

<script>
import LayoutLogin from '../Shared/LayoutLogin.vue';
import { Link } from '@inertiajs/inertia-vue3';

  export default {
    name: 'Login',
    layout: LayoutLogin,

    components: {
      Link
    },

    props: {
      errors: Array
    },

    data() {
      return {
        name: '',
        email: '',
        password: '',
        c_password: '',
      }
    },

    methods: {
      submit: function () {
        this.$inertia.post('/user/new', {
          name: this.name,
          email: this.email,
          password: this.password,
          c_password: this.c_password,
        }, {
          preserveState: (page) => Object.keys(page.props.errors).length,
        });
      }
    }
  }

</script>
