import { useState } from '@wordpress/element';
import IdeaStep from './components/IdeaStep';
import OutlineStep from './components/OutlineStep';
import DraftStep from './components/DraftStep';
import CheckListStep from './components/ChecklistStep';

const Sidebar = () => {
    const [step, setStep] = useState( 1 );

    return (
        <div style={{ padding: '16px' }} >
            <h2>WriteFlow</h2>
            { step === 1 && <IdeaStep onNext={ () => setStep( 2 ) } /> }
            { step === 2 && <OutlineStep onNext={ () => setStep( 3 ) } onBack={ () => setStep( 1 ) } /> }
            { step === 3 && <DraftStep onNext={ () => setStep( 4 ) } onBack={ () => setStep( 2 ) } /> }
            { step === 4 && <CheckListStep onBack={ () => setStep( 3 ) } /> }
        </div>
    );
};

export default Sidebar;