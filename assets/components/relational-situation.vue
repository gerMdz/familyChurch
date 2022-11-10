<template>
  <div :class="$style.component">
        <span
            v-for="relational in relationalSituation"
            :key="relational['id']"
            :class="{ selected: relational['id'] === selectedIRI }"
            :title="relational.name"
            @click="selectRelationalSituation(relational['id'])"
        />
  </div>
</template>

<script>
import { fetchRelationalSituation } from '/assets/store/services/relational_situation';

export default {
  name: 'RelationalSituation',
  data() {
    return {
      relationalSituation: {},
      selectedIRI: null,
    };
  },
  async created() {
    this.relationalSituation = (await fetchRelationalSituation()).data['hydra:member'];
    console.log(this.relationalSituation)
  },
  methods: {
    selectRelationalSituation(iri) {
      this.selectedIRI = iri;
      this.$emit('relationalSituation-selected', iri);
    },
  },
};
</script>

<style lang="scss" module>
.component :global {
  height: 25px;

  span {
    display: inline-block;
    border-radius: 4px;
    border: 2px solid transparent;
    cursor: pointer;
    width: 25px;
    height: 25px;
    margin-right: 10px;

    &.selected {
      border: 2px solid black
    }
  }
}
</style>
