<template>
  <div class="flex min-h-full flex-1 flex-col justify-center px-6 py-12 lg:px-8 h-full min-w-full bg-gray-900">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
      <img class="mx-auto h-10 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=500" alt="Your Company" />
      <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-white">Sign in to your account</h2>
    </div>

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
      <form @submit.prevent="submit" class="space-y-6" action="#" method="POST">
        <div>
          <label for="email" class="block text-sm font-medium leading-6 text-white">Email address</label>
          <div class="mt-2">
            <input v-model="email" type="email" autocomplete="email" required="" class="block w-full rounded-md border-0 bg-white/5 py-1.5 text-white shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:text-sm sm:leading-6" />
          </div>
        </div>

        <div>
          <div class="flex items-center justify-between">
            <label for="password" class="block text-sm font-medium leading-6 text-white">Password</label>

          </div>
          <div class="mt-2">
            <input v-model="password" type="password" autocomplete="current-password" required="" class="block w-full rounded-md border-0 bg-white/5 py-1.5 text-white shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:text-sm sm:leading-6" />
          </div>
        </div>

        <div v-if="$page.props.error">
          <div class="rounded-md bg-red-50 p-4">
            <div class="flex">
              <div class="flex-shrink-0">
                <CheckCircleIcon class="h-5 w-5 text-red-400" aria-hidden="true" />
              </div>
              <div class="ml-3">
                <p class="text-sm font-medium text-red-800">{{ $page.props.error }}</p>
              </div>
              <div class="ml-auto pl-3">
                <div class="-mx-1.5 -my-1.5">
                  <button type="button" class="inline-flex rounded-md bg-red-50 p-1.5 text-red-500 hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-red-600 focus:ring-offset-2 focus:ring-offset-red-50">
                    <span class="sr-only">Dismiss</span>
                    <XMarkIcon class="h-5 w-5" aria-hidden="true" />
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div>
          <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-500 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">
            Sign in
          </button>
        </div>

      </form>

      <p class="mt-10 text-center text-sm text-gray-400">
        Not a member?
        {{ ' ' }}
        <Link href="/register" class="font-semibold leading-6 text-indigo-400 hover:text-indigo-300">Register</link>
      </p>

    </div>
  </div>

</template>

<script>
import LayoutLogin from '../Shared/LayoutLogin.vue';
import { Link } from '@inertiajs/inertia-vue3';
import { CheckCircleIcon, XMarkIcon } from '@heroicons/vue/20/solid'

  export default {
    name: 'Login',
    layout: LayoutLogin,

    components: {
      Link, CheckCircleIcon, XMarkIcon
    },

    data() {
      return {
        email: '',
        password: ''
      }
    },

    methods: {
      submit: function () {
        this.$inertia.post('/signin', {
          email: this.email,
          password: this.password
        });
      }
    }
  }

</script>
