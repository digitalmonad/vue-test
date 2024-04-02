<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { Toaster } from '@/components/ui/sonner';
import DeviceTable from '@/components/deviceStorage/DeviceTable.vue';
import CreateDeviceSheet from '@/components/deviceStorage/CreateDeviceSheet.vue';
import Separator from '@/components/ui/separator/Separator.vue';

import { getDeviceList } from '@/api/deviceStorageApi';

let data = ref<any>();

onMounted(async () => {
  const response = await getDeviceList();
  data.value = response;

  console.log(data.value);
});

const onDeviceCreated = (e) => {
  data.value = [...data.value, e];
};
</script>

<template>
  <div class="h-screen w-full flex pt-20 justify-center">
    <div class="container">
      <h1 class="text-2xl">Device list</h1>
      <Separator class="mt-2 mb-8" />
      <DeviceTable :data="data" class="mb-10" />
      <CreateDeviceSheet @device-created="onDeviceCreated" />
    </div>
  </div>
  <Toaster position="bottom-left" richColors />
</template>
