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

          <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-2">
            <div class="px-4 py-6 sm:p-8">
              <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                <div class="sm:col-span-4">

                  <div class="mt-2">
                    <Listbox as="div" v-model="selectedFarm" @change="onFarmSelected">
                      <ListboxLabel class="block text-sm font-medium leading-6 text-gray-900">Farm</ListboxLabel>
                      <div class="relative mt-2">
                        <ListboxButton class="relative w-full cursor-default rounded-md bg-white py-1.5 pl-3 pr-10 text-left text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6">
                          <span class="block truncate">{{ selectedFarm.name }}</span>
                          <span class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2">
                            <ChevronUpDownIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
                          </span>
                        </ListboxButton>

                        <transition leave-active-class="transition ease-in duration-100" leave-from-class="opacity-100" leave-to-class="opacity-0">
                          <ListboxOptions class="absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm">
                            <ListboxOption as="template" v-for="farm in farms" :key="farm.id" :value="farm" v-slot="{ active, selectedFarm }">
                              <li :class="[active ? 'bg-indigo-600 text-white' : 'text-gray-900', 'relative cursor-default select-none py-2 pl-3 pr-9']">
                                <span :class="[selectedFarm ? 'font-semibold' : 'font-normal', 'block truncate']">{{ farm.name }}</span>

                                <span v-if="selectedFarm" :class="[active ? 'text-white' : 'text-indigo-600', 'absolute inset-y-0 right-0 flex items-center pr-4']">
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
                  <button @click="$inertia.visit('/inspections')" type="button"
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
          </div>
        </div>
      </div>


      <div v-if="inspections.farmId !== 0">
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
            <span class="font-bold text-indigo-600">{{ inspections.farmName }}</span>
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

import { Listbox, ListboxButton, ListboxLabel, ListboxOption, ListboxOptions } from '@headlessui/vue'
import { CheckIcon, ChevronUpDownIcon } from '@heroicons/vue/20/solid'
import Table from '../../Shared/TableDefault.vue';

export default {
  name: 'Inspections/List',

  components: {
    Table,
    Listbox, ListboxButton, ListboxLabel, ListboxOption, ListboxOptions,
    CheckIcon, ChevronUpDownIcon
  },

  props: {
    farms: Object,
    inspections: Object
  },

  async created() {
    this.selectedFarm = { id: 0, name: 'Select a farm' };
    // if (this.selectedFarm.id !== 0){
    //   await this.getInspections();
    //   // this.tableInspectionsDetails.rows = await this.getInspectionsRows();
    // }
  },

  data() {
    return {
      header: {
        title: 'Inspections List',
      },
      selectedFarm: null,
      tableInspectionsDetails: {
        editlink: '/inspections/new',

        title: 'Inspections List',
        description: 'A list of all turbines inspections of the farm.',
        button: {
          label: 'New Inspection',
          action: '/inspections/new',
          data: {
            farmId: this.inspections.farmId
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

  watch: {
    inspections: {
      immediate: true,
      handler(newInspections) {
        this.tableInspectionsDetails.rows = this.getInspectionsRows(newInspections);
      },
    },
  },

  methods: {
    async getInspections() {
      const url = `/inspections`;
      await this.$inertia.visit(url, {
        only: ['inspections','farms' ],
        method: 'post',
        data: {
          farmId: this.selectedFarm.id
        }
      });
      this.tableInspectionsDetails.rows = await this.getInspectionsRows();
    },

    onFarmSelected() {
      if (this.selectedFarm.id !== 0) {
        this.getInspections();
      }
    },

    getInspectionsRows(newInspections) {
      console.log('getInspectionsRows', newInspections);
      return newInspections.list.map(inspection => ({
            0: inspection.id,
            1: inspection.turbine,
            2: inspection.inspection_date,
          }))
    }
  },
}

</script>