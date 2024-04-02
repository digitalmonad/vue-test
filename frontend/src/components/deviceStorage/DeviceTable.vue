<script setup lang="ts">
import {
  Table,
  TableBody,
  TableCell,
  TableHead,
  TableHeader,
  TableRow,
} from '@/components/ui/table';
import { Device } from '@/lib/types/deviceStorage';

import { defineProps } from 'vue';

const props = defineProps<{
  data: Device[];
}>();
</script>

<template>
  <Table>
    <TableHeader>
      <TableRow isHead>
        <TableHead class="min-w-[200px]"> Hostname </TableHead>
        <TableHead class="flex-1/2"> Device Type </TableHead>
        <TableHead class="flex-1/2"> Os Type </TableHead>
        <TableHead class="text-right"> Owner name </TableHead>
      </TableRow>
    </TableHeader>
    <TableBody>
      <TableRow v-for="(device, index) in props.data" :key="index">
        <TableCell class="font-medium">
          {{ device.hostName }}
        </TableCell>
        <TableCell>{{ device.deviceType }}</TableCell>
        <TableCell>{{ device.osType }}</TableCell>
        <TableCell class="text-right">
          {{ device.ownerName }}
        </TableCell>
      </TableRow>
    </TableBody>
  </Table>
</template>
