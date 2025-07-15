<template>
  <AppLayout>
    <div class="flex justify-between items-center mb-4 md:mb-6 text-black">
      <h1 class="text-xl md:text-2xl font-bold text-black">Teachers</h1>
      <div class="flex items-center space-x-4 text-black">
        <div class="flex items-center space-x-2 bg-gray-100 rounded-md p-1 text-black">
          <button 
            @click="viewMode = 'table'" 
            :class="{ 'bg-white shadow-sm': viewMode === 'table' }" 
            class="p-2 rounded flex items-center text-black"
            title="Table View"
          >
            <TableCellsIcon class="h-5 w-5" />
            <span class="ml-1 text-sm hidden sm:inline text-black">Table</span>
          </button>
          <button 
            @click="viewMode = 'card'" 
            :class="{ 'bg-white shadow-sm': viewMode === 'card' }" 
            class="p-2 rounded flex items-center text-black"
            title="Card View"
          >
            <Squares2X2Icon class="h-5 w-5" />
            <span class="ml-1 text-sm hidden sm:inline text-black">Card</span>
          </button>
          <div class="relative">
            <button 
              @click="showFilter = !showFilter" 
              class="p-2 rounded flex items-center hover:bg-white text-black"
              title="Filter"
            >
              <AdjustmentsHorizontalIcon class="h-5 w-5" />
              <span class="ml-1 text-sm hidden sm:inline text-black">All</span>
            </button>
            <div v-if="showFilter" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-10">
              <select 
                v-model="selectedClass"
                @change="filterTeachers"
                class="block w-full px-4 py-2 text-sm border-gray-300 rounded-md text-black"
              >
                <option value="" class="text-black">All</option>
                <option 
                  v-for="classItem in classes" 
                  :key="classItem.id" 
                  :value="classItem.id" 
                  class="text-black"
                >
                  {{ classItem.class_name }}
                </option>
              </select>
            </div>
          </div>
        </div>
        <Link 
          href="/teachers/create" 
          class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded flex items-center"
        >
          <PlusIcon class="h-5 w-5 mr-1" />
          Add Teacher
        </Link>
      </div>
    </div>

    <div v-if="viewMode === 'table'" class="overflow-x-auto text-black">
      <table class="min-w-full bg-white border rounded shadow text-sm md:text-base text-black">
        <thead class="bg-gray-100">
          <tr>
            <th class="px-4 py-2 border text-center text-black">#</th>
            <th class="px-4 py-2 border text-left text-black">Name</th>
            <th class="px-4 py-2 border text-left text-black">Gender</th>
            <th class="px-4 py-2 border text-left text-black">Email</th>
            <th class="px-4 py-2 border text-center text-black">Class</th>
            <th class="px-4 py-2 border text-center text-black">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="(teacher, index) in teachers"
            :key="teacher.id"
            class="hover:bg-gray-50 text-black"
          >
            <td class="px-4 py-2 border text-center text-black">{{ index + 1 }}</td>
            <td class="px-4 py-2 border text-left text-black">{{ teacher.name }}</td>
            <td class="px-4 py-2 border text-left capitalize text-black">{{ teacher.gender }}</td>
            <td class="px-4 py-2 border text-left text-black">{{ teacher.email }}</td>
            <td class="px-4 py-2 border text-center text-black">{{ teacher.class?.class_name || '-' }}</td>
            <td class="px-4 py-2 border text-black">
              <div class="flex justify-center space-x-2">
                <button
                  class="flex items-center px-3 py-1 text-xs md:text-sm bg-blue-500 text-white rounded hover:bg-blue-600"
                  @click="editTeacher(teacher.id)"
                >
                  <PencilSquareIcon class="h-4 w-4 mr-1" />
                  Edit
                </button>
                <button
                  class="flex items-center px-3 py-1 text-xs md:text-sm bg-red-500 text-white rounded hover:bg-red-600"
                  @click="deleteTeacher(teacher.id)"
                >
                  <TrashIcon class="h-4 w-4 mr-1" />
                  Delete
                </button>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <div v-else class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 text-black">
      <div 
        v-for="(teacher, index) in teachers"
        :key="teacher.id"
        class="bg-white rounded-lg shadow-md overflow-hidden transition-transform duration-300 hover:scale-105 hover:shadow-lg"
      >
        <div class="bg-gray-200 h-40 flex items-center justify-center">
          <div class="relative w-24 h-24 rounded-full bg-indigo-100 flex items-center justify-center">
            <span class="text-3xl font-bold text-indigo-600">{{ teacher.name.charAt(0) }}</span>
          </div>
        </div>
        <div class="p-4 text-black">
          <div class="flex justify-between items-start">
            <div>
              <h3 class="font-bold text-lg text-black">{{ teacher.name }}</h3>
              <p class="text-gray-600 capitalize">{{ teacher.gender }}</p>
              <p class="text-sm text-gray-500">{{ teacher.class?.class_name || 'No class' }}</p>
              <p class="text-sm text-gray-500">{{ teacher.email }}</p>
            </div>
            <span class="bg-gray-100 text-gray-800 text-xs font-medium px-2.5 py-0.5 rounded">
              #{{ index + 1 }}
            </span>
          </div>
          <div class="mt-4 flex space-x-2">
            <button
              @click="editTeacher(teacher.id)"
              class="flex-1 flex items-center justify-center px-2 py-1 text-xs md:text-sm bg-blue-500 text-white rounded hover:bg-blue-600"
            >
              <PencilSquareIcon class="h-4 w-4 mr-1" />
              Edit
            </button>
            <button
              @click="deleteTeacher(teacher.id)"
              class="flex-1 flex items-center justify-center px-2 py-1 text-xs md:text-sm bg-red-500 text-white rounded hover:bg-red-600"
            >
              <TrashIcon class="h-4 w-4 mr-1" />
              Delete
            </button>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<script setup>
import { router, Link } from '@inertiajs/vue3'
import { ref } from 'vue'
import AppLayout from '@/layouts/AppLayout.vue'
import { 
  AdjustmentsHorizontalIcon,
  PlusIcon, 
  PencilSquareIcon, 
  TrashIcon, 
  TableCellsIcon, 
  Squares2X2Icon 
} from '@heroicons/vue/24/outline'

const props = defineProps({
  teachers: Array,
  classes: Array,
  filters: Object,
})

const selectedClass = ref(props.filters.class_id || '')
const viewMode = ref('table')
const showFilter = ref(false)

function filterTeachers() {
  router.get('/teachers', { class_id: selectedClass.value }, {
    preserveState: true,
    replace: true
  })
}

function editTeacher(id) {
  router.visit(`/teachers/${id}/edit`)
}

function deleteTeacher(id) {
  if (confirm('Are you sure you want to delete this teacher?')) {
    router.delete(`/teachers/${id}`)
  }
}
</script>
