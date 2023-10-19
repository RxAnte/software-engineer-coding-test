import { ReactNode } from 'react';

const ToDoLayout = ({ children }: { children: ReactNode }) => (
    <div className="mx-auto max-w-2xl">
        {children}
    </div>
);

export default ToDoLayout;
