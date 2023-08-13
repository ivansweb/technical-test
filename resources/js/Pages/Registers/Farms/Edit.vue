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
        <div class="grid grid-cols-1 gap-x-8 gap-y-8 md:grid-cols-1">

          <form @submit.prevent="save" class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-2">
            <div class="px-4 py-6 sm:p-8">
              <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                <div class="sm:col-span-4">
                  <label class="block text-sm font-medium leading-6 text-gray-900">Name</label>
                  <div class="mt-2">
                    <input v-model="form.name"
                           class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                           placeholder="Name of farm"/>
                  </div>
                </div>

                <div class="col-span-full h-full w-full">
                  <!--  TODO: Get the address to put on map-->
                </div>

              </div>
            </div>
            <div class="flex items-center justify-end gap-x-6 border-t border-gray-900/10 px-4 py-4 sm:px-8">
              <button @click="$inertia.visit('/registers/farms')" type="button"
                      class="text-sm font-semibold leading-6 text-gray-900">
                Cancel
              </button>
              <button type="submit"
                      class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                {{ farm ? 'Update' : 'Save' }}
              </button>
            </div>
          </form>
        </div>
      </div>
      
      <div v-show="farm">
        <div class="relative my-5">
          <div class="absolute inset-0 flex items-center" aria-hidden="true">
            <div class="w-full border-t border-gray-400"/>
          </div>
          <div class="relative flex justify-center">
            <span
                class=" rounded-md bg-white shadow px-3 text-base font-semibold leading-6 text-gray-900">Turbines</span>
          </div>
        </div>

        <div class="bg-gray-50">
          <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl px-4 py-5">
            <Table :tableDetails="tableDetails"/>
          </div>
        </div>
      </div>


    </div>
  </div>

</template>

<script>
import Table from '../../../Shared/TableDefault.vue';

export default {
  name: 'Registers/Farms/Edit',

  components: {
    Table
  },

  props: {
    farm: {
      type: Object
    }
  },

  async created() {
    this.tableDetails.rows = await this.getRows();
  },

  data() {
    return {
      header: {
        title: this.farm ? 'Farm data' : 'New farm',
      },
      form: {
        name: this.farm ? this.farm.name : ''
      },
      tableDetails: {
        editlink: '/registers/turbines/edit',
        title: 'Turbines List',
        description: 'A list of all turbnines of the farm.',
        button: {
          label: 'New Turbine',
          action: '/registers/turbines/new'
        },
        columns: [
          '#ID',
          'Model',
          'Manufacturer',
          'Instalation Date',
        ],
        rows: [],
      }
    }
  },

  methods: {
    async save() {
      const data = {
        name: this.form.name
      };

      if (this.farm) {
        data.id = this.farm.id;
        await this.redirect('update', data);
      } else {
        await this.redirect('save', data);
      }
    },

    async redirect(method, data) {
      const url = method === 'update'
          ? `/registers/farms/edit/${data.id}`
          : '/registers/farms/';

      await this.$inertia[method === 'update' ? 'put' : 'post'](url, data);
    },

    getRows() {
      return this.farm && this.farm.turbines
          ? this.farm.turbines.map(turbine => ({
            0: turbine.id,
            1: turbine.model,
            2: turbine.manufacturer,
            3: turbine.installation_date,
          }))
          : [];
    }
  },


}

</script>
