const Page = () => (
    <div className="mx-auto max-w-2xl">
        <div className="p-1 m-4">
            <div className="pb-4">
                <a
                    href="#todo-back-to-list"
                    className="rounded-full bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                >
                    &lArr; Back to list
                </a>
            </div>
            <h1 className="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
                Note Title
            </h1>
            <p className="mt-6 text-xl leading-8 text-gray-700">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dignissimos error fugiat voluptate! Ea est ipsa quisquam totam. Aliquam, asperiores eum fuga id iste laboriosam laborum maiores quisquam repellat saepe tempore.
            </p>
        </div>
    </div>
);

export default Page;
