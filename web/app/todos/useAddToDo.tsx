import { useState } from 'react';
import AddToDoOverlay from './AddToDoOverlay';

const useAddToDo = () => {
    const [isOpen, setIsOpen] = useState(false);

    return {
        isOpen,
        setIsOpen,
        renderOverlay: <AddToDoOverlay
            isOpen={isOpen}
            setIsOpen={setIsOpen}
        />,
    };
};

export default useAddToDo;
