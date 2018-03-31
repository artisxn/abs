<template>
    <div v-if="histories">
        <price-graph :histories="histories"></price-graph>
        <ranking-graph :histories="histories"></ranking-graph>
        <total-graph :histories="histories"></total-graph>
    </div>
</template>

<script>
import PriceGraph from "./chart/PriceGraph.vue";
import TotalGraph from "./chart/TotalGraph.vue";
import RankingGraph from "./chart/RankingGraph.vue";

export default {
  components: { PriceGraph, TotalGraph, RankingGraph },
  data() {
    return {
      histories: null
    };
  },
  props: ["asin"],
  mounted() {
    this.get_graph_data();
  },
  methods: {
    get_graph_data() {
      axios
        .get("/api/graph/" + this.asin)
        .then(res => {
          this.histories = res.data.data;
        })
        .catch(error => {
          console.log(error);
        });
    }
  }
};
</script>
