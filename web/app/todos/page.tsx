'use client';

import { useQuery } from '@tanstack/react-query';
import Loading from '../Loading';
import { ToDo } from './ToDo';
import useAddToDo from './useAddToDo';

const HomePage = () => {
    const fetchUrl = 'http://localhost:55781/todos';

    const {
        setIsOpen,
        renderOverlay,
    } = useAddToDo();

    const {
        status,
        data,
    } = useQuery<Array<ToDo>>({
        queryKey: [fetchUrl],
        queryFn: async () => {
            const response = await fetch(fetchUrl);

            return response.json();
        },
    });

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
                    {data.map((item) => (
                        <li
                            key={item.id}
                            className="flex items-center justify-between gap-x-6 py-5"
                        >
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
                                >
                                    {item.isDone ? 'Mark Not Done' : 'Mark Done'}
                                </button>
                                <button
                                    type="button"
                                    className="ml-1 rounded-full bg-white px-2.5 py-1 text-xs font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50"
                                >
                                    Delete
                                </button>
                            </div>
                        </li>
                    ))}
                </ul>
            </div>
        </>
    );
};

export default HomePage;
