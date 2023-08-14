<template>
  <div class="overflow-hidden rounded-lg bg-white shadow">
    <div class="px-4 py-5 sm:px-6">
      <div class="md:flex md:items-center md:justify-between">
        <div class="min-w-0 flex-1">
          <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">Turbine List</h2>
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
  name: 'Registers/Turbines/Index',

  components: {
    Table
  },

  props: {
    turbines: {
      type: Object,
      required: true
    }
  },

  async created() {
    this.tableDetails.rows = await this.getRows();
  },

  data() {
    return {
      tableDetails: {
        editlink: '/registers/turbines/new',
        title: 'Turbines List',
        description: 'A list of all turbnines of the farm.',
        button: {
          label: 'New Turbine',
          action: '/registers/turbines/new',
          data: {
            farmId: this.farm ? this.farm.id : null
          }
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
    getRows: function () {
      return this.turbines && this.turbines.data
          ? this.turbines.data.map(turbine => ({
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
