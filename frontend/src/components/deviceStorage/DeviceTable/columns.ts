import { h } from 'vue';
import type { ColumnDef } from '@tanstack/vue-table';
import { Device } from '@/lib/types/deviceStorage';
import { Button } from '@/components/ui/button';
import { ArrowDownIcon, ArrowUpIcon, RowSpacingIcon } from '@radix-icons/vue';

export const columns: ColumnDef<Device>[] = [
  {
    accessorKey: 'hostName',
    header: ({ column }) => {
      return h(
        Button,
        {
          class: 'text-left text-muted-foreground p-0',
          variant: 'link',
          onClick: () => column.toggleSorting(column.getIsSorted() === 'asc'),
        },
        () => [
          'Host Name',
          h(
            (() => {
              const sort = column.getIsSorted();
              return sort === 'asc'
                ? ArrowUpIcon
                : sort === 'desc'
                ? ArrowDownIcon
                : RowSpacingIcon;
            })(),
            {
              class: 'ml-2 h-4 w-4',
            }
          ),
        ]
      );
    },
    cell: ({ row }) =>
      h('div', { class: 'lowercase' }, row.getValue('hostName')),
  },
  {
    accessorKey: 'ownerName',
    header: ({ column }) => {
      return h(
        Button,
        {
          class: 'text-muted-foreground p-0 self-end',
          variant: 'link',
          onClick: () => column.toggleSorting(column.getIsSorted() === 'asc'),
        },
        () => [
          'Owner Name',
          h(
            (() => {
              const sort = column.getIsSorted();
              return sort === 'asc'
                ? ArrowUpIcon
                : sort === 'desc'
                ? ArrowDownIcon
                : RowSpacingIcon;
            })(),
            {
              class: 'ml-2 h-4 w-4 flex-3',
            }
          ),
        ]
      );
    },
    cell: ({ row }) => {
      return h(
        'div',
        { class: 'text-left font-medium' },
        row.getValue('ownerName')
      );
    },
  },
  {
    accessorKey: 'deviceType',
    header: () => h('div', { class: 'text-right' }, 'Device Type'),
    cell: ({ row }) => {
      return h(
        'div',
        { class: 'text-right font-medium' },
        row.getValue('deviceType')
      );
    },
  },
  {
    accessorKey: 'osType',
    header: () => h('div', { class: 'text-right' }, 'OS Type'),
    cell: ({ row }) => {
      return h(
        'div',
        { class: 'text-right font-medium' },
        row.getValue('osType')
      );
    },
  },
];
