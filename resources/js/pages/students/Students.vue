<template>
  <AppLayout>
    <div class="flex justify-between items-center mb-4 md:mb-6">
      <h1 class="text-xl md:text-2xl font-bold text-black">Students</h1>
      <div class="flex items-center space-x-4">
        <div class="flex items-center space-x-2 bg-gray-100 rounded-md p-1">
          <button 
            @click="viewMode = 'table'" 
            :class="{'bg-white shadow-sm': viewMode === 'table'}" 
            class="p-2 rounded flex items-center text-black"
            title="Table View"
          >
            <TableCellsIcon class="h-5 w-5" />
            <span class="ml-1 text-sm hidden sm:inline text-black">Table</span>
          </button>
          <button 
            @click="viewMode = 'card'" 
            :class="{'bg-white shadow-sm': viewMode === 'card'}" 
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
                @change="filterStudents"
                class="block w-full px-4 py-2 text-sm border-gray-300 rounded-md text-black"
              >
                <option value="" class="text-black">All</option>
                <option v-for="classItem in classes" :key="classItem.id" :value="classItem.id" class="text-black">
                  {{ classItem.class_name }}
                </option>
              </select>
            </div>
          </div>
        </div>
        <Link 
          href="/students/create" 
          class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded flex items-center"
        >
          <PlusIcon class="h-5 w-5 mr-1" />
          Add Student
        </Link>
      </div>
    </div>

    <div v-if="viewMode === 'table'" class="overflow-x-auto">
      <table class="min-w-full bg-white border rounded shadow text-sm md:text-base">
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
            v-for="(student, index) in students"
            :key="student.id"
            class="hover:bg-gray-50"
          >
            <td class="px-4 py-2 border text-center text-black">{{ index + 1 }}</td>
            <td class="px-4 py-2 border text-left text-black">{{ student.name }}</td>
            <td class="px-4 py-2 border text-left capitalize text-black">{{ student.gender }}</td>
            <td class="px-4 py-2 border text-left text-black">{{ student.email }}</td>
            <td class="px-4 py-2 border text-center text-black">{{ student.class?.class_name || '-' }}</td>
            <td class="px-4 py-2 border">
              <div class="flex justify-center space-x-2">
                <button
                  class="flex items-center px-3 py-1 text-xs md:text-sm bg-blue-500 text-white rounded hover:bg-blue-600"
                  @click="editStudent(student.id)"
                >
                  <PencilSquareIcon class="h-4 w-4 mr-1" />
                  Edit
                </button>
                <button
                  class="flex items-center px-3 py-1 text-xs md:text-sm bg-red-500 text-white rounded hover:bg-red-600"
                  @click="deleteStudent(student.id)"
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

    <div v-else class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
      <div 
        v-for="(student, index) in students"
        :key="student.id"
        class="bg-white rounded-lg shadow-md overflow-hidden transition-transform duration-300 hover:scale-105 hover:shadow-lg"
      >
        <div class="bg-gray-200 h-40 flex items-center justify-center">
          <div class="relative w-24 h-24 rounded-full bg-indigo-100 flex items-center justify-center">
            <span class="text-3xl font-bold text-indigo-600">{{ student.name.charAt(0) }}</span>
          </div>
        </div>
        <div class="p-4">
          <div class="flex justify-between items-start">
            <div>
              <h3 class="font-bold text-lg text-black">{{ student.name }}</h3>
              <p class="text-gray-600 capitalize">{{ student.gender }}</p>
              <p class="text-sm text-gray-500">{{ student.class?.class_name || 'No class' }}</p>
              <p class="text-sm text-gray-500">{{ student.email }}</p>
            </div>
            <span class="bg-gray-100 text-gray-800 text-xs font-medium px-2.5 py-0.5 rounded">
              #{{ index + 1 }}
            </span>
          </div>
          <div class="mt-4 flex space-x-2">
            <button
              @click="editStudent(student.id)"
              class="flex-1 flex items-center justify-center px-2 py-1 text-xs md:text-sm bg-blue-500 text-white rounded hover:bg-blue-600"
            >
              <PencilSquareIcon class="h-4 w-4 mr-1" />
              Edit
            </button>
            <button
              @click="deleteStudent(student.id)"
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
import { router, Link } from '@inertiajs/vue3';
import { ref } from 'vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { 
  AdjustmentsHorizontalIcon,
  PlusIcon, 
  PencilSquareIcon, 
  TrashIcon, 
  TableCellsIcon, 
  Squares2X2Icon 
} from '@heroicons/vue/24/outline';

const props = defineProps({
  students: Array,
  classes: Array,
  filters: Object,
});

const selectedClass = ref(props.filters.class_id || '');
const viewMode = ref('table');
const showFilter = ref(false);

function filterStudents() {
  router.get('/students', { class_id: selectedClass.value }, {
    preserveState: true,
    replace: true
  });
}

function editStudent(id) {
  router.visit(`/students/${id}/edit`);
}

function deleteStudent(id) {
  if (confirm('Are you sure you want to delete this student?')) {
    router.delete(`/students/${id}`);
  }
}
</script>
