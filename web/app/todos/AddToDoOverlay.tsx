import { createPortal } from 'react-dom';
import {
    Dispatch,
    SetStateAction,
    Fragment,
} from 'react';
import { Dialog, Transition } from '@headlessui/react';

const AddToDoOverlay = (
    {
        isOpen,
        setIsOpen,
    }: {
        isOpen: boolean;
        setIsOpen: Dispatch<SetStateAction<boolean>>;
    },
) => {
    console.log('here');

    return createPortal(
        // eslint-disable-next-line @typescript-eslint/ban-ts-comment
        // @ts-ignore
        <Transition.Root show={isOpen} as={Fragment}>
            <Dialog as="div" className="relative z-10" onClose={() => {}}>
                <Transition.Child
                    as={Fragment}
                    enter="ease-out duration-300"
                    enterFrom="opacity-0"
                    enterTo="opacity-100"
                    leave="ease-in duration-200"
                    leaveFrom="opacity-100"
                    leaveTo="opacity-0"
                >
                    <div className="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" />
                </Transition.Child>
                <div className="fixed inset-0 z-10 w-screen overflow-y-auto">
                    <div className="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                        <Transition.Child
                            as={Fragment}
                            enter="ease-out duration-300"
                            enterFrom="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                            enterTo="opacity-100 translate-y-0 sm:scale-100"
                            leave="ease-in duration-200"
                            leaveFrom="opacity-100 translate-y-0 sm:scale-100"
                            leaveTo="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                        >
                            <div className="w-full relative">
                                <div className="mx-auto max-w-2xl">
                                    <div className="m-4 relative">
                                        <div className="overflow-hidden rounded-lg border border-gray-300 focus-within:border-indigo-500 focus-within:ring-1 focus-within:ring-indigo-500 bg-white shadow-xl">
                                            <label htmlFor="title" className="sr-only">Title</label>
                                            <input
                                                type="text"
                                                name="title"
                                                id="title"
                                                className="block w-full border-0 pt-2.5 text-lg font-medium placeholder:text-gray-400 focus:ring-0 focus-visible:border-0 focus-visible:outline-0 px-3"
                                                placeholder="Title"
                                            />
                                            <div aria-hidden="true">
                                                <div className="py-1" />
                                                <div className="h-px" />
                                                <div className="py-2">
                                                    <div className="py-px">
                                                        <div className="h-9" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div className="absolute inset-x-px bottom-0">
                                            <div className="border-t border-gray-200 px-2 py-2 sm:px-3">
                                                <div className="text-right">
                                                    <button
                                                        onClick={() => {
                                                            setIsOpen(false);
                                                        }}
                                                        type="button"
                                                        className="rounded-full border border-gray-200 px-4 py-2.5 text-sm font-semibold text-gray-900 shadow-sm hover:bg-gray-100 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                                                    >
                                                        Cancel
                                                    </button>
                                                    <button
                                                        type="button"
                                                        className="rounded-full bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 ml-1"
                                                    >
                                                        Create
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </Transition.Child>
                    </div>
                </div>
            </Dialog>
        </Transition.Root>,
        document.body,
        'add-to-do-overlay',
    );
};

export default AddToDoOverlay;
