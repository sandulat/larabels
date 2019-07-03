<template>
  <div class="rounded bg-white shadow mx-auto overflow-hidden">
    <div
      class="cursor-pointer flex items-center justify-between px-5 py-4 bg-gray-100 border-b uppercase text-sm tracking-widest font-medium text-gray-700"
      @click="toggle"
    >
      {{ title }}
      <component :is="iconComponent" class="w-4 h-4 text-gray-500" />
    </div>

    <div v-show="open" class="px-5 py-5 overflow-x-auto">
      <slot />
    </div>
  </div>
</template>

<script>
import IconPlus from "./icons/IconPlus.vue";
import IconMinus from "./icons/IconMinus.vue";

export default {
  components: {
    IconPlus,
    IconMinus
  },
  props: {
    title: {
      type: String,
      required: true
    }
  },
  data: () => ({
    open: true
  }),
  computed: {
    iconComponent() {
      return this.open ? "icon-minus" : "icon-plus";
    }
  },
  methods: {
    toggle() {
      this.open = !this.open;
    }
  }
};
</script>
