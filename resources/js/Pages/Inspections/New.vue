<template>
  <div class="overflow-hidden rounded-lg bg-white shadow">
    <div class="px-4 py-5 sm:px-6">
      <div class="md:flex md:items-center md:justify-between">
        <div class="min-w-0 flex-1">
          <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">
            New inspection from
            <span class="text-indigo-600">{{ farm.name }}</span>
          </h2>
        </div>
      </div>
    </div>
    <div class="bg-gray-50 px-4 py-5 sm:p-6">
      <div class="space-y-10 divide-y divide-gray-900/10">
        <div class="grid grid-cols-1 gap-x-8 gap-y-8 md:grid-cols-1">

          <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-2">
            <div class="px-4 py-6 sm:p-8">

              <RadioGroup v-model="selectedTurbine">
                <RadioGroupLabel class="text-base font-semibold leading-6 text-gray-900">Select a turbine
                </RadioGroupLabel>

                <div class="mt-4 grid grid-cols-1 gap-y-6 sm:grid-cols-3 sm:gap-x-4">
                  <RadioGroupOption as="template" v-for="turbine in turbines" :key="turbine.id" :value="turbine"
                                    v-slot="{ active, checked }">
                    <div
                        :class="[active ? 'border-indigo-600 ring-2 ring-indigo-600' : 'border-gray-300', 'relative flex cursor-pointer rounded-lg border bg-white p-4 shadow-sm focus:outline-none']">
                      <span class="flex flex-1">
                        <span class="flex flex-col">
                          <RadioGroupLabel as="span" class="block text-sm font-medium text-gray-900">{{
                              turbine.name
                            }}</RadioGroupLabel>
                          <RadioGroupDescription as="span" class="mt-1 flex items-center text-sm text-gray-500">{{
                              turbine.serial_number
                            }}</RadioGroupDescription>
                        </span>
                      </span>
                      <CheckCircleIcon :class="[!checked ? 'invisible' : '', 'h-5 w-5 text-indigo-600']"
                                       aria-hidden="true"/>
                      <span
                          :class="[active ? 'border' : 'border-2', checked ? 'border-indigo-600' : 'border-transparent', 'pointer-events-none absolute -inset-px rounded-lg']"
                          aria-hidden="true"/>
                    </div>
                  </RadioGroupOption>
                </div>
              </RadioGroup>


            </div>

            <div class="px-4 py-2 sm:p-8 border-t border-gray-900/10">
              <ul role="list" class="divide-y divide-gray-100">
                <li v-for="component in components" :key="component.id"
                    class="relative flex justify-between gap-x-8 px-4 py-5 hover:bg-gray-50 sm:px-6 lg:px-8">
                  <div class="flex min-w-0 gap-x-4">
                    <div class="min-w-0 flex-auto">
                      <p class="text-sm font-semibold leading-6 text-gray-900">
                        <span class="absolute inset-x-0 -top-px bottom-0"/>
                        {{ component.name }}
                      </p>
                      <div class="flex shrink-0 items-center gap-x-6">
                          <RadioGroup v-model="component.selectedGrade">

                            <div class="mt-4 grid grid-cols-1 gap-y-6 sm:grid-cols-5 sm:gap-x-4">
                              <RadioGroupOption as="template" v-for="grade in grades" :key="grade.id" :value="grade"
                                                v-slot="{ active, checked }">
                                <div
                                    :class="[active ? 'border-indigo-600 ring-2 ring-indigo-600' : 'border-gray-300', 'relative flex cursor-pointer rounded-lg border bg-white p-4 shadow-sm focus:outline-none']">
                                  <span class="flex flex-1">
                                    <span class="flex flex-col">
                                      <RadioGroupLabel as="span" class="block text-sm font-medium text-gray-900">
                                        {{
                                          grade.name
                                        }}
                                      </RadioGroupLabel>

                                    </span>
                                  </span>
                                  <CheckCircleIcon :class="[!checked ? 'invisible' : '', 'h-5 w-5 text-indigo-600']"
                                                   aria-hidden="true"/>
                                  <span
                                      :class="[active ? 'border' : 'border-2', checked ? 'border-indigo-600' : 'border-transparent', 'pointer-events-none absolute -inset-px rounded-lg']"
                                      aria-hidden="true"/>

                                </div>
                              </RadioGroupOption>
                            </div>
                          </RadioGroup>
                      </div>
                    </div>
                  </div>
                </li>
              </ul>
            </div>
            <div class="flex items-center justify-end gap-x-6 border-t border-gray-900/10 px-4 py-4 sm:px-8">
              <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button>
              <button type="button" @click="nextStep()"
                      class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                Next
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</template>


<script>
import {RadioGroup, RadioGroupDescription, RadioGroupLabel, RadioGroupOption} from '@headlessui/vue'
import {CheckCircleIcon, ChevronRightIcon} from '@heroicons/vue/20/solid'

export default {
  name: 'Registers/Inspections/New',

  components: {
    CheckCircleIcon, ChevronRightIcon,
    RadioGroup, RadioGroupDescription, RadioGroupLabel, RadioGroupOption
  },

  props: {
    farm: {
      type: Array
    },
    components: {
      type: Array
    },
    grades: {
      type: Array
    },
  },

  created() {
    this.turbines = this.farm.turbines;
    this.selectedTurbine = this.turbines[0];
    this.selectedGrade = this.grades[0];
  },

  data() {
    return {
      turbines: null,
      selectedTurbine: null,
      selectedGrade: null,
    }
  },

  methods: {
    nextStep: function () {
      const data = {
        farmId: this.farm.id,
        turbineId: this.selectedTurbine.id,
        components: this.components,
      }
     
      this.$inertia.post('/inspections/store', data);
    }
  }


}

</script>
