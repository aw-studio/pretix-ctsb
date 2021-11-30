import { useForm } from "@inertiajs/inertia-vue3";

export interface TAttendeNameParts {
    _scheme: string;
    given_name: string;
    family_name: string;
}
export interface TAnswer {
    question: number;
    answer: string | null;
    question_identifier: string | null;
    options: any[];
    option_identifiers: any[];
}
export interface TPosition {
    positionid: number;
    item: number;
    variation: any;
    price: string;
    attendee_name_parts: TAttendeNameParts,
    attendee_email: string | null,
    addon_to: any,
    answers: TAnswer[],
    subevent: number
}
export interface TFee {
    fee_type: string;
    value: string;
    description: string;
    internal_type: string;
    tax_rule: number | null;
  
}
export interface TBooking {
    email: string | null;
    email_confirmation: string | null;
    locale: string;
    sales_channel: string;
    fees: TFee[];
    payment_provider: string;
    positions: TPosition[]
}

export const form = useForm<TBooking>({
    email: null,
    email_confirmation: null,
    locale: "de",
    sales_channel: "web",
    fees: [
      {
        fee_type: "payment",
        value: "0.0",
        description: "a",
        internal_type: "a",
        tax_rule: null // <- this
      }
    ],
    payment_provider: "free",
    positions: [
      {
        positionid: 1,
        item: null, // <- this
        variation: null,
        price: "0.00",
        attendee_name_parts: {
          _scheme: "given_family", 
          given_name: "Givenname",
          family_name: "Familyname"
        },
        attendee_email: null,
        addon_to: null,
        answers: [],
        subevent: null // <- this
      }
    ]
})


export interface TQuestionConfig {
  question: number;
  question_identifier: string;
  type: string;
}
export interface TInitFormConfig {
  organizers: string;
  event: string;
  item: number;
  subevent: number;
  tax_rule: number;
  questions: any[];
}

const initAnswer = (answer: TAnswer) => {
  return {
    question: answer.question,
    answer: null,
    question_identifier: answer.question_identifier,
    options: [],
    option_identifiers: []
  }
}

const initAnswers = (questions: any[]) => {
  return questions.map((stage: TAnswer[]) => {
    return stage.map((question: TAnswer) => initAnswer(question));
   }).flat()
}

export const initForm = (config: TInitFormConfig) => {  
  form.fees[0].tax_rule = config.tax_rule
  form.positions[0].item = config.item
  form.positions[0].answers = initAnswers(config.questions)
  form.positions[0].subevent = config.subevent
}

