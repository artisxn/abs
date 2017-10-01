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
            text: '価格'
          },
        }
      }
    },
    props: [
      'histories'
    ],
    mounted() {
      this.get_graph_data();
    },
    methods: {
      get_graph_data() {
        const labels = _.reverse(_.map(this.histories, 'day'));
        const lowest_new_price = _.reverse(_.map(this.histories, 'lowest_new_price'));
        const lowest_used_price = _.reverse(_.map(this.histories, 'lowest_used_price'));

        const datasets = [
          {
            label: '新品',
            data: lowest_new_price,
            backgroundColor: '#1e87f0',
            borderColor: '#1e87f0',
            fill: false
          },
          {
            label: '中古',
            data: lowest_used_price,
            backgroundColor: '#f0506e',
            borderColor: '#f0506e',
            fill: false
          }
        ];

        this.data = {
          labels: labels,
          datasets: datasets,
        }
      },
    }
  }

</script>
