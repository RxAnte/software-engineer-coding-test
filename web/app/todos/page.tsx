'use client';

import Loading from '../Loading';
import useAddToDo from './useAddToDo';
import { useToDoData } from './ToDoData';
import ToDoItem from './ToDoItem';

const HomePage = () => {
    const {
        setIsOpen,
        renderOverlay,
    } = useAddToDo();

    const {
        status,
        data,
    } = useToDoData();

    if (status === 'loading') {
        return <Loading />;
    }

    if (!data || data.length < 1) {
        return (
            <>
                {renderOverlay}
                <div className="p-4 border border-gray-100 rounded-md shadow-md m-4">
                    <div className="text-center">
                        <h3 className="mt-2 text-sm font-semibold text-gray-900">No ToDos</h3>
                        <p className="mt-1 text-sm text-gray-500">Get started by creating one.</p>
                        <div className="mt-6">
                            <button
                                onClick={() => {
                                    setIsOpen(true);
                                }}
                                type="button"
                                className="inline-flex items-center rounded-full bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                            >
                                <svg className="-ml-0.5 mr-1.5 h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                                </svg>
                                Add ToDo
                            </button>
                        </div>
                    </div>
                </div>
            </>
        );
    }

    return (
        <>
            {renderOverlay}
            <div className="p-1 m-4 text-right">
                <button
                    onClick={() => {
                        setIsOpen(true);
                    }}
                    type="button"
                    className="inline-flex items-center rounded-full bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                >
                    <svg className="-ml-0.5 mr-1.5 h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                    </svg>
                    Add ToDo
                </button>
            </div>
            <div className="p-4 border border-gray-100 rounded-md shadow-md m-4">
                <ul className="divide-y divide-gray-100">
                    {data.map((item) => <ToDoItem key={item.id} item={item} />)}
                </ul>
            </div>
        </>
    );
};

export default HomePage;
