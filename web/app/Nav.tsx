'use client';

import Link from 'next/link';
import { usePathname } from 'next/navigation';

type Tabs = Array<{
    title: string;
    href: string;
    isActive: boolean;
}>;

const Nav = () => {
    const pathName = usePathname();
    const segments = pathName.split('/').filter((seg) => seg !== '');

    const tabs = [
        {
            title: 'ToDos',
            href: '/todos',
            isActive: segments[0] === 'todos',
        },
    ] as Tabs;

    return (
        <nav className="isolate flex divide-x divide-gray-200 rounded-lg shadow" aria-label="Tabs">
            {tabs.map((tab) => {
                if (tab.isActive) {
                    return (
                        <Link
                            className="text-gray-900 rounded-l-lg group relative min-w-0 flex-1 overflow-hidden bg-white py-4 px-4 text-center text-sm font-medium hover:bg-gray-50 focus:z-10"
                            key={tab.href}
                            href={tab.href}
                            aria-current="page"
                        >
                            <span>{tab.title}</span>
                            <span
                                aria-hidden="true"
                                className="bg-indigo-500 absolute inset-x-0 bottom-0 h-0.5"
                            />
                        </Link>
                    );
                }

                return (
                    <Link
                        className="text-gray-500 hover:text-gray-700 group relative min-w-0 flex-1 overflow-hidden bg-white py-4 px-4 text-center text-sm font-medium hover:bg-gray-50 focus:z-10"
                        key={tab.href}
                        href={tab.href}
                        aria-current="page"
                    >
                        <span>{tab.title}</span>
                        <span aria-hidden="true" className="bg-transparent absolute inset-x-0 bottom-0 h-0.5" />
                    </Link>
                );
            })}
        </nav>
    );
};

export default Nav;
