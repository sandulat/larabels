<template>
  <div>
    <div>
      <button
        v-for="(tab, index) in tabs"
        :key="index"
        :class="tabActive(tab) ? 'text-indigo-700 border-indigo-700' : 'text-gray-700 border-transparent'"
        class="uppercase font-medium mb-4 py-1 border-b-2 mr-3"
        type="button"
        @click="setActiveTab(tab)"
      >{{ tab }}</button>
    </div>
    <slot :active-tab="activeTab" />
  </div>
</template>

<script>
export default {
  props: {
    tabs: {
      type: Array,
      required: true
    }
  },
  data() {
    return {
      activeTab: this.tabs[0]
    };
  },
  methods: {
    setActiveTab(tab) {
      this.activeTab = tab;
    },
    tabActive(tab) {
      return this.activeTab === tab;
    }
  }
};
</script>

