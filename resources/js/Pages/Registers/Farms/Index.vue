<template>
  <div class="overflow-hidden rounded-lg bg-white shadow">
    <div class="px-4 py-5 sm:px-6">
      <div class="md:flex md:items-center md:justify-between">
        <div class="min-w-0 flex-1">
          <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">Farm List</h2>
        </div>
      </div>
    </div>
    <div class="bg-gray-50 px-4 py-5 sm:p-6">
      <Table :tableDetails="tableDetails"/>
    </div>
  </div>
</template>

<script>
import Table from '../../../Shared/TableDefault.vue';

export default {
  name: 'Registers/Farms/Index',

  components: {
    Table
  },

  props: {
    farms: {
      type: Array,
      required: true
    }
  },

  data() {
    return {
      tableDetails: {
        editlink: '/registers/farms/edit',
        title: 'Farm List',
        description: 'A list of all the farms.',
        button: {
          label: 'New Farm',
          action: '/registers/farms/new'
        },
        columns: [
          '#ID',
          'Name'
        ],
        data: this.farms.data
      }
    }
  }
}

</script>
