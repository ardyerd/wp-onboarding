import { CheckboxControl } from '@wordpress/components';

const ChecklistStep = ( { onBack } ) => {
    return (
        <>
            <CheckboxControl label="Clear introduction?" />
            <CheckboxControl label="One idea per section?" />
            <CheckboxControl label="Short paragraphs?" />
            <CheckboxControl label="Clear conclusion?" /> 
        </>
    );
};
export default ChecklistStep;