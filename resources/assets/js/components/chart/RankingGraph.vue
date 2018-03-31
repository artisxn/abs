<template>
  <div v-if="data">
    <line-chart :data="data" :options="options" :height="100"></line-chart>
  </div>

</template>

<script>
import LineChart from "./LineChart";

export default {
  components: { LineChart },
  data() {
    return {
      data: null,
      datasets: [],
      labels: [],
      options: {
        title: {
          display: true,
          position: "top",
          text: "ランキング"
        },
        scales: {
          yAxes: [
            {
              ticks: {
                beginAtZero: true
              },
              gridLines: {
                display: true
              }
            }
          ],
          xAxes: [
            {
              gridLines: {
                display: true
              }
            }
          ]
        }
      }
    };
  },
  props: ["histories"],
  mounted() {
    const labels = _.reverse(_.map(this.histories, "day"));
    const rank = _.reverse(_.map(this.histories, "rank"));

    const datasets = [
      {
        label: "ランキング",
        data: rank,
        backgroundColor: "#32d296",
        borderColor: "#32d296",
        fill: false
      }
    ];

    this.data = {
      labels: labels,
      datasets: datasets
    };
  }
};
</script>
