<template>
  <div v-if="data">
    <line-chart :data="data" :options="options" :height="100"></line-chart>
  </div>

</template>

<script>
  import LineChart from './LineChart'

  export default {
    components: {LineChart},
    data() {
      return {
        data: null,
        datasets: [],
        labels: [],
        options: {
          title: {
            display: true,
            position: 'top',
            text: '出品数'
          },
        }
      }
    },
    props: [
      'histories'
    ],
    mounted() {
      const labels = _.reverse(_.map(this.histories, 'day'));
      const total_new = _.reverse(_.map(this.histories, 'total_new'));
      const total_used = _.reverse(_.map(this.histories, 'total_used'));

      const datasets = [
        {
          label: '新品',
          data: total_new,
          backgroundColor: '#28a5f5',
          borderColor: '#28a5f5',
          fill: false
        },
        {
          label: '中古',
          data: total_used,
          backgroundColor: '#f0708e',
          borderColor: '#f0708e',
          fill: false
        }
      ]

      this.data = {
        labels: labels,
        datasets: datasets,
      }
    },

  }

</script>
