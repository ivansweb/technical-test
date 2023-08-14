<template>
  <div class="overflow-hidden rounded-lg bg-white shadow">
    <div class="px-4 py-5 sm:px-6">
      <div class="md:flex md:items-center md:justify-between">
        <div class="min-w-0 flex-1">
          <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">
            {{ header.title }}
          </h2>
        </div>
      </div>
    </div>
    <div class="bg-gray-50 px-4 py-5 sm:p-6">
      <div class="space-y-10 divide-y divide-gray-900/10">
        <form @submit.prevent="save" class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl ">
          <div class="px-4 py-6 sm:p-8">
            <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 md:col-span-2">
              <div class="sm:col-span-3">
                <label class="block text-sm font-medium leading-6 text-gray-900">Model</label>
                <div class="mt-2">
                  <input v-model="form.model" autocomplete="given-name"
                         class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"/>
                </div>
              </div>

              <div class="sm:col-span-3">
                <label class="block text-sm font-medium leading-6 text-gray-900">Manufacturer</label>
                <div class="mt-2">
                  <input v-model="form.manufacturer" autocomplete="family-name"
                         class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"/>
                </div>
              </div>

              <div class="sm:col-span-4">
                <label class="block text-sm font-medium leading-6 text-gray-900">Serial</label>
                <div class="mt-2">
                  <input v-model="form.serialNumber" autocomplete="email"
                         class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"/>
                </div>
              </div>

              <div class="sm:col-span-3">
                <label for="country" class="block text-sm font-medium leading-6 text-gray-900">Installation Date</label>
                <div class="mt-2">
                  <input v-model="form.installationDate" type="date" autocomplete="email"
                         class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"/>
                </div>
              </div>

            </div>
          </div>
          <div class="flex items-center justify-end gap-x-6 border-t border-gray-900/10 px-4 py-4 sm:px-8">
            <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button>
            <button type="submit"
                    class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
              {{ toUpdate ? 'Update' : 'Save' }}
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>

export default {
  name: 'Registers/Turbines/New',

  components: {},

  props: {
    turbine: {
      type: Array
    }
  },

  data() {
    return {
      header: {
        title: this.toUpdate ? 'Turbine data' : 'New Turbine',
      },
      toUpdate: Object.keys(this.turbine).length > 0,
      form: {
        model: !this.toUpdate ? this.turbine.model : '',
        serialNumber: !this.toUpdate ? this.turbine.serial_number : '',
        manufacturer: !this.toUpdate ? this.turbine.manufacturer : '',
        installationDate: !this.toUpdate ? this.turbine.installation_date : ''
      },
    }
  },

  methods: {
    save: function () {

      const queryString = this.$page.url.split('?')[1];
      const params = new URLSearchParams(queryString);
      const farmId = params.get('farmId');

      let data = {
        farm_id: farmId ?? this.turbine.farm_id,
        model: this.form.model,
        manufacturer: this.form.manufacturer,
        serial_number: this.form.serialNumber,
        installation_date: this.form.installationDate,
      };

      if (this.toUpdate) {
        data.id = this.turbine.id;
        this.redirect('update', data);
      } else {
        this.redirect('save', data);
      }

    },

    redirect: function (method, data) {
      if (method === 'update') {
        this.$inertia.put(`/registers/turbines/edit/${data.id}`, data);
        return;
      }

      this.$inertia.post('/registers/turbines/', data);
    }
  }


}

</script>
