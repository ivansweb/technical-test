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

                  <div class="mt-2">
                    <Listbox as="div" v-model="selected">
                      <ListboxLabel class="block text-sm font-medium leading-6 text-gray-900">Farm</ListboxLabel>
                      <div class="relative mt-2">
                        <ListboxButton class="relative w-full cursor-default rounded-md bg-white py-1.5 pl-3 pr-10 text-left text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6">
                          <span class="block truncate">{{ selected.name }}</span>
                          <span class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2">
                            <ChevronUpDownIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
                          </span>
                        </ListboxButton>

                        <transition leave-active-class="transition ease-in duration-100" leave-from-class="opacity-100" leave-to-class="opacity-0">
                          <ListboxOptions class="absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm">
                            <ListboxOption as="template" v-for="farm in farms" :key="farm.id" :value="farm" v-slot="{ active, selected }">
                              <li :class="[active ? 'bg-indigo-600 text-white' : 'text-gray-900', 'relative cursor-default select-none py-2 pl-3 pr-9']">
                                <span :class="[selected ? 'font-semibold' : 'font-normal', 'block truncate']">{{ farm.name }}</span>

                                <span v-if="selected" :class="[active ? 'text-white' : 'text-indigo-600', 'absolute inset-y-0 right-0 flex items-center pr-4']">
                                  <CheckIcon class="h-5 w-5" aria-hidden="true" />
                                </span>
                              </li>
                            </ListboxOption>
                          </ListboxOptions>
                        </transition>
                      </div>
                    </Listbox>
                  </div>
                </div>

                <div class="flex items-center gap-x-8 mt-5 px-5 py-4 sm:px-8 ">
                  <button @click="$inertia.visit('/registers/farms')" type="button"
                          class="text-sm font-semibold leading-6 text-gray-900">
                    Cancel
                  </button>
                  <button type="button" @click="getInspections"
                          class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    Select
                  </button>
                </div>

              </div>
            </div>
          </form>
        </div>
      </div>

      <div v-if="inspections">
        <div class="relative my-5 mx-10">
          <div class="absolute inset-0 flex items-center" aria-hidden="true">
            <div class="w-full border-t border-gray-400"/>
          </div>
          <div class="relative flex justify-center">
            <span
                class=" rounded-md bg-white shadow px-3 text-base font-semibold leading-6 text-gray-900">Inspections</span>
          </div>
        </div>

        <div class="relative my-5 mx-10">
          <h3 class="text-base font-semibold leading-6 text-gray-900">
            Showing
            <span class="font-bold text-indigo-600">{{ inspections[0].farm_name }}</span>
            Inspections
          </h3>
        </div>

        <div class="bg-gray-50">
          <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl px-4 py-5">
            <Table :tableDetails="tableInspectionsDetails"/>
          </div>
        </div>
      </div>

      <div v-else >
        <div class="relative my-5">
          <div class="absolute inset-0 flex items-center" aria-hidden="true">
            <div class="w-full border-t border-gray-400"/>
          </div>
          <div class="relative flex justify-center">
            <span
                class=" rounded-md bg-white shadow px-3 text-base font-semibold leading-6 text-gray-900">Inspections</span>
          </div>
        </div>

        <div class="bg-gray-50">
          <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl px-4 py-5">
            Select a farm to see the inspections.
          </div>
        </div>
      </div>


    </div>
  </div>

</template>

<script>
import Table from '../../Shared/TableDefault.vue';
import { router } from '@inertiajs/vue3'
import { Listbox, ListboxButton, ListboxLabel, ListboxOption, ListboxOptions } from '@headlessui/vue'
import { CheckIcon, ChevronUpDownIcon } from '@heroicons/vue/20/solid'

export default {
  name: 'Inspections/List',

  components: {
    Table,
    Listbox, ListboxButton, ListboxLabel, ListboxOption, ListboxOptions,
    CheckIcon, ChevronUpDownIcon
  },

  props: {
    farms: {
      type: Object
    },
    inspections: {
      type: Object
    }
  },

  async created() {
    this.tableInspectionsDetails.rows = await this.getInspectionsRows();
  },

  data() {
    return {
      header: {
        title: 'Inspections List',
      },
      selected: { id: 0, name: 'Select a farm' },
      tableInspectionsDetails: {
        editlink: '/inspections/new',

        title: 'Inspections List',
        description: 'A list of all turbines inspections of the farm.',
        button: {
          label: 'New Inspection',
          action: '/inspections/new',
          data: {
            farmId: this.inspections ? this.inspections[0].farm_id : null
          }
        },
        columns: [
          '#ID',
          'Turbine',
          'Inspection Date',
        ],
        rows: [],
      },
    }
  },

  methods: {
    async getInspections() {
      const url = `/inspections`;
      router.visit(url, {
        only: ['inspections','farms' ],
        method: 'post',
        data: {only: ['inspections'],

          farmId: this.selected.id
        }
      })

    },

    async redirect(method, data) {
      const url = method === 'update'
          ? `/registers/farms/edit/${data.id}`
          : '/registers/farms/';

      await this.$inertia[method === 'update' ? 'put' : 'post'](url, data);
    },

    getInspectionsRows() {
      return this.inspections
          ? this.inspections.map(inspection => ({
            0: inspection.id,
            1: inspection.turbine,
            2: inspection.inspection_date,
          }))
          : [];
    }
  },


}

</script>
