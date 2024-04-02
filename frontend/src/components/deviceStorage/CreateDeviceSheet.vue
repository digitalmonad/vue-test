<script setup lang="ts">
import { toTypedSchema } from '@vee-validate/zod';
import { useForm } from 'vee-validate';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { toast } from 'vue-sonner';
import {
  Sheet,
  SheetContent,
  SheetDescription,
  SheetFooter,
  SheetHeader,
  SheetTitle,
  SheetTrigger,
} from '@/components/ui/sheet';

import {
  FormField,
  FormItem,
  FormLabel,
  FormMessage,
  FormDescription,
} from '@/components/ui/form';

import {
  Select,
  SelectContent,
  SelectGroup,
  SelectItem,
  SelectTrigger,
  SelectValue,
} from '@/components/ui/select';

import { createDevice } from '@/api/deviceStorageApi';
import { DeviceSchema } from '@/lib/types/deviceStorage';
import { ref, defineEmits } from 'vue';

const formSchema = toTypedSchema(DeviceSchema);

const { handleSubmit, isSubmitting } = useForm({
  validationSchema: formSchema,
});

const onSubmit = handleSubmit(async (values) => {
  try {
    await createDevice({
      hostname: values.hostName,
      device_type: values.deviceType,
      os_type: values.osType,
      owner_name: values.ownerName,
    });

    emit('device-created', values);
    isOpen.value = false;
    toast.success('Device created successfully');
  } catch (error) {
    console.log(error);
    toast.error(error?.response?.data);
  }
});

const isOpen = ref(false);

const emit = defineEmits(['device-created']);
</script>

<template>
  <Sheet :open="isOpen" @update:open="(open) => (isOpen = open)">
    <SheetTrigger as-child>
      <Button variant="outline" @click="isOpen = true"> Add new </Button>
    </SheetTrigger>
    <SheetContent>
      <SheetHeader>
        <SheetTitle>Add new device</SheetTitle>
        <SheetDescription>
          Be sure that the combination of device type and OS options makes
          sense.
        </SheetDescription>
      </SheetHeader>
      <div class="grid gap-4 py-4">
        <form class="flex flex-col gap-y-4">
          <FormField v-slot="{ componentField }" name="hostName">
            <FormItem>
              <FormLabel>Host name</FormLabel>
              <FormControl>
                <Input
                  type="text"
                  placeholder="host name"
                  v-bind="componentField"
                />
              </FormControl>
              <FormDescription> Name of the host. </FormDescription>
              <FormMessage />
            </FormItem>
          </FormField>
          <FormField v-slot="{ componentField }" name="deviceType">
            <FormItem>
              <FormLabel>Device Type</FormLabel>
              <FormControl>
                <Select v-bind="componentField">
                  <SelectTrigger class="w-[180px]">
                    <SelectValue placeholder="Select device type" />
                  </SelectTrigger>
                  <SelectContent>
                    <SelectGroup>
                      <SelectItem
                        v-for="type in DeviceSchema.shape.deviceType.options"
                        :key="type"
                        :value="type"
                        >{{ type }}</SelectItem
                      >
                    </SelectGroup>
                  </SelectContent>
                </Select>
              </FormControl>
              <FormMessage />
            </FormItem>
          </FormField>
          <FormField v-slot="{ componentField }" name="osType">
            <FormItem>
              <FormLabel>OS Type</FormLabel>
              <FormControl>
                <Select v-bind="componentField">
                  <SelectTrigger class="w-[180px]">
                    <SelectValue placeholder="Select OS type" />
                  </SelectTrigger>
                  <SelectContent>
                    <SelectGroup>
                      <SelectItem
                        v-for="type in DeviceSchema.shape.osType.options"
                        :key="type"
                        :value="type"
                        >{{ type }}</SelectItem
                      >
                    </SelectGroup>
                  </SelectContent>
                </Select>
              </FormControl>
              <FormMessage />
            </FormItem>
          </FormField>
          <FormField v-slot="{ componentField }" name="ownerName">
            <FormItem>
              <FormLabel>Owner name</FormLabel>
              <FormControl>
                <Input
                  type="text"
                  placeholder="owner name"
                  v-bind="componentField"
                />
              </FormControl>
              <FormDescription> Name of the owner. </FormDescription>
              <FormMessage />
            </FormItem>
          </FormField>
        </form>
      </div>
      <SheetFooter>
        <Button :disabled="isSubmitting" type="submit" @click="onSubmit">
          Create new device
        </Button>
      </SheetFooter>
    </SheetContent>
  </Sheet>
</template>
