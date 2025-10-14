import { ref, mergeProps, useSSRContext } from "vue";
import { ssrRenderAttrs, ssrInterpolate } from "vue/server-renderer";
const _sfc_main = {
  __name: "Test",
  __ssrInlineRender: true,
  setup(__props) {
    const count = ref(0);
    return (_ctx, _push, _parent, _attrs) => {
      _push(`<div${ssrRenderAttrs(mergeProps({ class: "min-h-screen bg-gray-100 flex items-center justify-center" }, _attrs))}><div class="bg-white p-8 rounded-lg shadow-lg text-center"><h1 class="text-3xl font-bold text-blue-600 mb-4">Inertia + Tailwind Test</h1><p class="text-gray-700">Если вы видите этот текст, Tailwind и Inertia работают!</p><button class="mt-4 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition"> Clicked ${ssrInterpolate(count.value)} times </button></div></div>`);
    };
  }
};
const _sfc_setup = _sfc_main.setup;
_sfc_main.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/Pages/Test.vue");
  return _sfc_setup ? _sfc_setup(props, ctx) : void 0;
};
export {
  _sfc_main as default
};
