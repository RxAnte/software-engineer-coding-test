import { ToDo } from './ToDo';
import { useDeleteMutation, useMarkAsDoneMutation, useMarkAsNotDoneMutation } from './ToDoData';

const ToDoItem = ({ item }: { item: ToDo }) => {
    const markAsDoneMutation = useMarkAsDoneMutation(item.id);

    const markAsNotDoneMutation = useMarkAsNotDoneMutation(item.id);

    const deleteMutation = useDeleteMutation(item.id);

    return (
        <li className="flex items-center justify-between gap-x-6 py-5">
            <div className="flex min-w-0 gap-x-4">
                <div className="min-w-0 flex-auto">
                    <p className={`text-sm font-semibold leading-6 ${item.isDone ? 'line-through text-gray-400' : 'text-gray-900'}`}>
                        {item.title}
                    </p>
                </div>
            </div>
            <div>
                <button
                    type="button"
                    className="rounded-full bg-white px-2.5 py-1 text-xs font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50"
                    onClick={() => {
                        if (item.isDone) {
                            markAsNotDoneMutation.mutate();

                            return;
                        }

                        markAsDoneMutation.mutate();
                    }}
                >
                    {item.isDone ? 'Mark Not Done' : 'Mark Done'}
                </button>
                <button
                    type="button"
                    className="ml-1 rounded-full bg-white px-2.5 py-1 text-xs font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50"
                    onClick={() => {
                        deleteMutation.mutate();
                    }}
                >
                    Delete
                </button>
            </div>
        </li>
    );
};

export default ToDoItem;
